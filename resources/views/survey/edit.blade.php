@extends('layouts.main')
@section('title'){{ 'Survey Edit' }}@endsection
@section('header.css')
    <style>

    </style>
@endsection
@section('main.content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Survey Edit</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Survey</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-wizard" action="{{ route('survey.update', $survey->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="surveyTitle">Survey Title</label><span class="text-danger">*</span>
                                            <input class="form-control" id="surveyTitle" name="title" type="text" placeholder="Survey Tile" value="{{ @$survey->title }}" required>
                                            <span class="text-danger"> <b>{{  $errors->first('title') }}</b></span>
                                        </div>    
                                        
                                        <div class="mb-3">
                                            <label for="surveyDescription">Description</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="description" name="description" type="text" placeholder="S" value="" required>{{ @$survey->description }}</textarea>
                                            <span class="text-danger"> <b>{{  $errors->first('description') }}</b></span>
                                        </div>  
                                                                               
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('survey.show') }}">Cancel</a></button>
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">               
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                        <h5>Questions</h5>
                            <div class="text-end mb-3">
                                <a  class="btn btn-md btn-info" onclick="addQuestion()"><i class="fa fa-plus"></i>Create New</a>
                            </div>
                            <div class="table-responsive">
                                <table id="questionTable" class="table table-striped"></table>
                            </div>
                        </div>
                    </div>
                </div>              
            </div>

            <div class="modal fade" id="productCreateModal" tabindex="-1" aria-labelledby="productCreateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productCreateModalLabel">Add Question</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="productCreateForm" method="POST" enctype="multipart/form-data">
                                @csrf    
                                <input type="hidden" name="question_id" id="questionId" value="0">                        
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group mb-4">
                                            <label class="label text-secondary">Question Title</label>
                                            <textarea  class="form-control h-55" placeholder="Question Title" id="title" value="" name="title"></textarea>
                                        </div>
                                    </div>                             
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="btnProductCreate">Create Question</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer.js')
   <script>
      $(document).ready(function () {
            $('#questionTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('question.list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                        d.survey_id = {{ @$survey->id }}
                    },
                },
                columns: [
                    {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
                    {title: 'Title', data: 'title', name: 'title', className: "text-center", orderable: true, searchable: true},                 
                    {title: 'Action', className: "text-center", data: function (data) {
                            return '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="editQuestion(this)"><i class="fa fa-edit"></i></a>'+
                                ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.id + '" onclick="deleteQuestion(this)"><i class="fa fa-trash"></i></a>'+
                                ' <a title="add answer" class="btn btn-info btn-sm" data-panel-id="' + data.id + '" onclick="addAnswer(this)"><i class="fa fa-plus"></i></a>'
                                ;
                        }, orderable: false, searchable: false
                    }
                ],
                "columnDefs": [
                    {
                        "targets": 2, 
                        "render": function(data, type, row) {                         
                            if (typeof data === 'string') {                            
                                return data.split(',').join('<br>');
                            } else {                              
                                return data;
                            }
                        }
                    }
                ]
                
            });
        });

    //Create Question
    function addQuestion() {
    $('#productCreateForm').trigger('reset');
    $('#productCreateForm').find('.is-invalid').removeClass('is-invalid');
    $('#productCreateForm').find('.CertificateAreaAjaxErrors').remove(); 

    let url = "{!! route('question.create') !!}";
    let survey_id = {{ @$survey->id ?? 'null' }};
    let csrfToken = $('meta[name="csrf-token"]').attr('content'); 

    $.ajax({
        type: 'GET',
        url: url,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': csrfToken 
        },
        data: {
            survey_id: survey_id
        },
        success: function(response) {                        
            if ($('#productCreateForm').find('#bookingId').length === 0) { 
                $('#productCreateForm').append(
                    `<input type="hidden" id="bookingId" name="survey_id" value="${response.survey.id}">`
                );
            } 
            $('#productCreateModal').modal('show');
        },
        error: function(error) {
            if (error.status === 404) {
                const errorMessage = error.responseJSON ? error.responseJSON.statusText : 'An error occurred';
                toastr.error(errorMessage, 'Error');
            }
        }
    });
}

//Submit Question Form
$('#productCreateForm').on('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();   
    $('#btnProductCreate').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Updating...');
    let formData = new FormData(this);   
    $('#productCreateForm').find('.CertificateAreaAjaxErrors').remove();
    $('#productCreateForm').find('.is-invalid').removeClass('is-invalid');

    $.ajax({
        type: 'POST',
        url: "{!! route('question.store') !!}",
        cache: false,
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            $('#productCreateForm').trigger('reset');
            // Clear and redraw the DataTable
            $('#questionTable').DataTable().ajax.reload();             
            $('#productCreateModal').modal('hide');          
            $('#btnProductCreate').prop('disabled', false).html('Update Product');          
            toastr.success(response.message || 'Product Store successfully!');
        },
        error: function (error) {           
            $('#btnProductCreate').prop('disabled', false).html('Update Product');
            if (error.status === 422) {                
                $.each(error.responseJSON.errors, function (key, value) {
                    let el = $('#productCreateForm').find(`[name="${key.replace('.', '\\.')}"]`);
                    el.addClass('is-invalid');
                    el.after(
                        $('<span class="text-danger CertificateAreaAjaxErrors"><b>' + value[0] + '</b></span>')
                    );
                });
            } else {              
                toastr.error('An unexpected error occurred. Please try again.');
            }
        },
    });
});

//Edit Question

function editQuestion(x) {
    let id = $(x).data('panel-id');
    $('#productCreateForm').trigger('reset');
    $('#productCreateForm').find('.is-invalid').removeClass('is-invalid');
    $('#productCreateForm').find('.CertificateAreaAjaxErrors').remove(); 
    let url = "{!! route('question.edit', ':id') !!}";
    url = url.replace(":id", id);

    $.ajax({
        type: 'GET',
        url: url,
        cache: false,
        data: {
            _token: "{{ csrf_token() }}",
            id: id
        },
        success: function(response) {            
            $('#questionId').val(response.question.id);
            $('#title').val(response.question.title); 
            $('#btnProductCreate').text('Update Topic'); 
            $('#productCreateModalLabel').text('Edit Topic');                        
            $('#productCreateModal').modal('show');
        },
        error: function(error) {
            if (error.status === 404) {
                Swal.fire({
                    title: "Error",
                    text: error.responseJSON.statusText,
                    icon: "error"
                });
            }
        }
    });
}

//Delete Question
function deleteQuestion(x) {
    let id = $(x).data('panel-id');
    if (!confirm("Delete This Question")) {
        return false;
    }
    $.ajax({
        type: 'POST',
        url: "{{ route('question.delete') }}",
        cache: false,
        data: {
            _token: "{{ csrf_token() }}",
            'id': id
        },
        success: function (data) {
            toastr.success('Question deleted successfully!');
            $('#questionTable').DataTable().clear().draw();
        },
    });
}

//Add answer

function addAnswer(x) {
    let btn = $(x).data('panel-id');
    let url = '{{route("answer.create", ":id") }}';
    window.location.href = url.replace(':id', btn);
}

   </script>
@endsection
