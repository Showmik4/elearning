@extends('layouts.main')
@section('title'){{ 'Kpi Complete' }}@endsection
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
                        <h3>Kpi Complete</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Kpi Complete</li>
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
                            <form class="form-wizard" action="{{ route('kpi.complete_kpi_submit', $complete_kpi->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <input type="hidden" name="fk_kpi_id" value="{{$complete_kpi->fk_kpi_id}}">
                                        <input type="hidden" name="fk_kpi_assign_id" value="{{$complete_kpi->id}}">
                                        <div class="row">
                                            <div class="mb-3">
                                            <label for="forMinor">Complete File</label><span class="text-danger">*</span>
                                            <input class="form-control" name="total_complete" type="number" value="{{$complete_kpi->total_complete}}" placeholder="Total Complete" >
                                                <span class="text-danger"><b>{{ $errors->first('total_complete') }}</b></span>
                                            </div>     
                                        </div>  
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </div>
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

</script>
@endsection