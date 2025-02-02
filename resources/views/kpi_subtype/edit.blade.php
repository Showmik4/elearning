@extends('layouts.main')
@section('title'){{ 'Kpi Sub Type Edit' }}@endsection
@section('header.css')
    <style>
    div.dataTables_wrapper div.dataTables_length label {
    font-weight: normal;
    text-align: left;
    white-space: nowrap;
    display: none;
    }

    div.dataTables_wrapper div.dataTables_filter label {
    font-weight: normal;
    white-space: nowrap;
    text-align: left;
    display:none;
    }
    </style>
@endsection
@section('main.content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Kpi Sub Type Edit</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Kpi Sub Type</li>
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
                            <form class="form-wizard" action="{{ route('kpi_subtype.update', $kpi_subtype->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="type">Kpi Type</label><span class="text-danger">*</span>
                                            <select class="form-control" name="fk_type_id">
                                                <option value="">Select Kpi Type</option>
                                                @foreach ($type as $types)
                                                <option value="{{$types->id}}" @if($kpi_subtype->fk_type_id === $types->id) selected @endif>{{$types->type_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('fk_type_id') }}</b></span>
                                        </div>   
                                        <div class="mb-3">
                                            <label for="subTypeName">SubType Name</label><span class="text-danger">*</span>
                                            <input class="form-control" id="subTypeName" name="subtype_name" type="text" placeholder="Sub Type Name" value="{{$kpi_subtype->subtype_name}}" required>
                                            <span class="text-danger"><b>{{  $errors->first('subtype_name') }}</b></span>
                                        </div>  

                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('kpi_subtype.show') }}">Cancel</a></button>
                                            <button class="btn btn-primary" type="submit">Create</button>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3">
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="text-end mb-3">
                                                                <a class="btn btn-md btn-info" onclick="addTopic()"><i class="fa fa-plus"></i>Create Topic</a>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table id="topicTable" class="table table-striped"></table>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>                                       
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!----------------------------------------Topic Modal -------------------------------------->
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
                            <input type="hidden" name="topicId" id="topicId" value="0">                        
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Topic Name</label>
                                        <input type="text" class="form-control h-55" placeholder="Topic Name" id="topicName" value="" name="topic_name">
                                    </div>
                                </div>                             
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="btnProductCreate">Create Topic</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer.js')

<script>

// Topic Table

$(document).ready(function () {
$('#topicTable').DataTable({
    processing: true,
    serverSide: true,   
    ajax: {
        "url": "{{route('topic.list')}}",
        "type": "POST",
        data: function (d) {
            d._token = "{{ csrf_token() }}";
            d.subtype_id = {{ @$kpi_subtype->id }}
        },
    },
    columns: [
        {title: 'ID', data: 'id', name: 'id', className: "text-center", orderable: true, searchable: true},
        {title: 'Topic Name', data: 'topic_name', name: 'topic_name', className: "text-center", orderable: true, searchable: true},               
        {title: 'Action', className: "text-center", data: function (data) {
                return '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="editTopic(this)"><i class="fa fa-edit"></i></a>'+
                    ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.id + '" onclick="deleteTopic(this)"><i class="fa fa-trash"></i></a>';
            }, orderable: false, searchable: false
        }
    ],              
    
});
});

// Add More Topic
function addTopic() {
    $('#productCreateForm').trigger('reset');
    $('#productCreateForm').find('.is-invalid').removeClass('is-invalid');
    $('#productCreateForm').find('.CertificateAreaAjaxErrors').remove(); 

    let url = "{!! route('topic.create') !!}";
    let subtype_id = {{ @$kpi_subtype->id ?? 'null' }};
    let csrfToken = $('meta[name="csrf-token"]').attr('content'); 

    $.ajax({
        type: 'GET',
        url: url,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': csrfToken 
        },
        data: {
            subtype_id: subtype_id
        },
        success: function(response) {                        
            if ($('#productCreateForm').find('#bookingId').length === 0) { 
                $('#productCreateForm').append(
                    `<input type="hidden" id="bookingId" name="fk_subtype_id" value="${response.subtype.id}">`
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

//Submit Topic Form
$('#productCreateForm').on('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();   
    $('#btnProductCreate').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Updating...');
    let formData = new FormData(this);   
    $('#productCreateForm').find('.CertificateAreaAjaxErrors').remove();
    $('#productCreateForm').find('.is-invalid').removeClass('is-invalid');

    $.ajax({
        type: 'POST',
        url: "{!! route('topic.store') !!}",
        cache: false,
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            $('#productCreateForm').trigger('reset');
            // Clear and redraw the DataTable
            $('#topicTable').DataTable().ajax.reload(); 
            
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


let topicCounter = 1; 
function addMoreTopic() {
    event.preventDefault();      
    const newTopicRowId = `topicRow${topicCounter}`;        
    var newTopicArea = `
        <div class="row" id="${newTopicRowId}">
             <div class="mb-3 col-md-6">
            <label for="forMinor">Sub Type Topic</label><span class="text-danger">*</span>
            <input class="form-control" id="topic" name="topic_name[]" type="text" placeholder="Topic Name" >
            <span class="text-danger"><b>{{ $errors->first('topic_name') }}</b></span>
            </div>
            <div class="mb-3 col-md-12">
                <button type="button" class="btn btn-primary px-5" onclick="addMoreTopic()">Add More</button>
                <button type="button" class="btn btn-danger px-5" onclick="removeTopic('${newTopicRowId}')">Remove</button>
            </div>
        </div>
    `;      
    $('#topicArea').append(newTopicArea);        
    topicCounter++;  
}

function removeTopic(rowId) {       
    $(`#${rowId}`).remove();
}

function editTopic(x) {
    let id = $(x).data('panel-id');
    $('#productCreateForm').trigger('reset');
    $('#productCreateForm').find('.is-invalid').removeClass('is-invalid');
    $('#productCreateForm').find('.CertificateAreaAjaxErrors').remove(); 
    let url = "{!! route('topic.edit', ':id') !!}";
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
            $('#topicId').val(response.topic.id);
            $('#topicName').val(response.topic.topic_name); 
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

function deleteTopic(x) {
    let id = $(x).data('panel-id');
    if (!confirm("Delete This Sub Type Topic")) {
        return false;
    }
    $.ajax({
        type: 'POST',
        url: "{{ route('topic.delete') }}",
        cache: false,
        data: {
            _token: "{{ csrf_token() }}",
            'id': id
        },
        success: function (data) {
            toastr.success('Topic deleted successfully!');
            $('#topicTable').DataTable().clear().draw();
        },
    });
}
</script>
@endsection