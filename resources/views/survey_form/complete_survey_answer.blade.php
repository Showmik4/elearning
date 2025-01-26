@extends('layouts.main')
@section('title'){{ 'Mutual Evolutions' }}@endsection
@section('header.css')
<style>
    /* General Styling */
    .page-title h3 {
        font-size: 1.75rem;
        font-weight: 600;
    }
    .breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
        list-style: none;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: '>';
        padding: 0 5px;
    }

    /* Card Styling */
    .survey-card {
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .survey-card-header {
        background-color: #f5f5f5;
        padding: 15px;
        border-bottom: 1px solid #ddd;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        font-weight: bold;
    }
    .survey-card-body {
        padding: 15px;
    }
    .survey-answer {
        font-size: 1rem;
        margin-bottom: 10px;
    }
    .survey-answer span {
        font-weight: bold;
    }
    .survey-feedback {
        font-size: 0.95rem;
        color: #555;
        margin-bottom: 15px;
    }

    /* Responsive Layout */
    @media (max-width: 768px) {
        .survey-card {
            margin-bottom: 15px;
        }
    }
</style>
@endsection

@section('main.content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Mutual Evolutions</h3>
                </div>
                <div class="col-6 text-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('index') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">Mutual Evolutions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $answer->first()->survey->title }} Mutual Evolution's By {{ $answer->first()->user->firstName }}</h5>
                    </div>
                </div>
            </div>
            <!-- Survey Answers -->
            <div class="col-md-12">
                <div class="row">
                    @php $i = 1; @endphp
                    @foreach ($answer as $item)
                    <div class="col-md-6">
                        <div class="survey-card">
                            <div class="survey-card-header">
                                Question {{ $i }}
                            </div>
                            <div class="survey-card-body">
                                <div class="survey-answer">
                                    <span>Q:</span> {{ $item->question->title }}
                                </div>
                                <div class="survey-answer">
                                    <span>Answer:</span> {{ $item->question_point->offered_answer }}
                                </div>
                                <div class="survey-feedback">
                                    <span>Feedback:</span> {{ $item->feedback }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $i++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer.js')
@endsection
