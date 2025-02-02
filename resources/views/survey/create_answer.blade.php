@extends('layouts.main')
@section('title'){{ 'Answer Create' }}@endsection
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
                        <h3>Answer Create</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Answer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">               
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-end mb-3">
                                <a  class="btn btn-md btn-info" onclick="addOption()"><i class="fa fa-plus"></i>Create New</a>
                            </div>
                            <div class="table-responsive">
                                <table id="answerTable" class="table table-striped"></table>
                            </div>
                        </div>
                    </div>
                </div>              
            </div>

            <div class="modal fade" id="productCreateModal" tabindex="-1" aria-labelledby="productCreateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productCreateModalLabel">Add Topic</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="productCreateForm" method="POST" enctype="multipart/form-data">
                                @csrf    
                                <input type="hidden" name="option_id" id="optionId" value="0">                        
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group mb-4">
                                            <label class="label text-secondary">Offered Answer</label>
                                            <input type="text" class="form-control h-55" placeholder="Offered Answer" id="offeredAnswer" value="" name="offered_answer">
                                        </div>
                                    </div>                             
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="btnProductCreate">Create Answer</button>
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
            $('#answerTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('answer.list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                        d.question_id = {{ @$question->id }}
                    },
                },
                columns: [
                    {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
                    {title: 'Offered Answer', data: 'offered_answer', name: 'offered_answer', className: "text-center", orderable: true, searchable: true},                 
                    {title: 'Action', className: "text-center", data: function (data) {
                            return '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="editAnswer(this)"><i class="fa fa-edit"></i></a>'+
                                ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.id + '" onclick="deleteAnswer(this)"><i class="fa fa-trash"></i></a>'                             
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

    //Create Answer
    function addOption() {
    $('#productCreateForm').trigger('reset');
    $('#productCreateForm').find('.is-invalid').removeClass('is-invalid');
    $('#productCreateForm').find('.CertificateAreaAjaxErrors').remove(); 

    let url = "{!! route('answer.add') !!}";
    let question_id = {{ @$question->id ?? 'null' }};
    let csrfToken = $('meta[name="csrf-token"]').attr('content'); 

    $.ajax({
        type: 'GET',
        url: url,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': csrfToken 
        },
        data: {
            question_id: question_id
        },
        success: function(response) {                        
            if ($('#productCreateForm').find('#bookingId').length === 0) { 
                $('#productCreateForm').append(`
                    <input type="hidden" id="questionId" name="question_id" value="${response.question.id}">
                    <input type="hidden" id="surveyId" name="survey_id" value="${response.question.survey_id}">
                `);
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

//Submit Offered Answer Form
$('#productCreateForm').on('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();   
    $('#btnProductCreate').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Updating...');
    let formData = new FormData(this);   
    $('#productCreateForm').find('.CertificateAreaAjaxErrors').remove();
    $('#productCreateForm').find('.is-invalid').removeClass('is-invalid');

    $.ajax({
        type: 'POST',
        url: "{!! route('answer.store') !!}",
        cache: false,
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            $('#productCreateForm').trigger('reset');
            // Clear and redraw the DataTable
            $('#answerTable').DataTable().ajax.reload();             
            $('#productCreateModal').modal('hide');          
            $('#btnProductCreate').prop('disabled', false).html('Update Product');          
            toastr.success(response.message || 'Offered Answer Store successfully!');
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

//Edit Answer

function editAnswer(x) {
    let id = $(x).data('panel-id');
    $('#productCreateForm').trigger('reset');
    $('#productCreateForm').find('.is-invalid').removeClass('is-invalid');
    $('#productCreateForm').find('.CertificateAreaAjaxErrors').remove(); 
    let url = "{!! route('answer.edit', ':id') !!}";
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
            $('#optionId').val(response.answer.id);
            $('#offeredAnswer').val(response.answer.offered_answer); 
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

//Delete Answer

//Delete Question
function deleteAnswer(x) {
    let id = $(x).data('panel-id');
    if (!confirm("Delete This Answer")) {
        return false;
    }
    $.ajax({
        type: 'POST',
        url: "{{ route('answer.delete') }}",
        cache: false,
        data: {
            _token: "{{ csrf_token() }}",
            'id': id
        },
        success: function (data) {
            toastr.success('Answer deleted successfully!');
            $('#answerTable').DataTable().clear().draw();
        },
    });
}
</script> 
@endsection