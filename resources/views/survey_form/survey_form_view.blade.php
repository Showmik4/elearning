@extends('layouts.main')
@section('title'){{ 'Mutual Evolution' }}@endsection
@section('header.css')
    <style>
        /* Styling for better readability and compact layout */
        .form-wizard {
            max-width: 900px;
            margin: 0 auto;
        }
        .form-section {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .form-section h6 {
            margin-bottom: 15px;
            font-weight: bold;
        }
        .btn-mb {
            margin-top: 20px;
        }
        .progress {
            height: 20px;
        }
    </style>
@endsection
@section('main.content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Mutual Evolution Survey</h3>
                    </div>
                    <div class="col-6 text-end">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h5>{{$survey->title}}</h5>
                            <p>Please complete all questions. Your feedback is valuable to us!</p>
                            {{-- <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
                                     role="progressbar" 
                                     style="width: 0%" 
                                     id="progressBar"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-wizard" action="{{ route('survey.submit_survey') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="survey_id" value="{{ $survey->id }}">

                                @php $i = 1; @endphp
                                @foreach ($survey->question as $index => $item)
                                    @if ($index % 5 === 0)
                                        <!-- Start new section after every 5 questions -->
                                        <div class="form-section">
                                            {{-- <h6>Section {{ ceil(($index + 1) / 5) }}</h6> --}}
                                    @endif
                                    
                                    <div class="mb-3">
                                        <label for="question_{{ $item->id }}" class="form-label">
                                            <strong>{{ $i }}. {{ $item->title }}</strong>
                                        </label>
                                        <input type="hidden" name="question_id[]" value="{{ $item->id }}">
                                        @foreach ($item->question_point as $option)
                                            <div class="form-check">
                                                <input 
                                                    type="radio" 
                                                    id="customRadio_{{ $option->id }}" 
                                                    name="offered_answer_id[{{ $item->id }}]" 
                                                    value="{{ $option->id }}" 
                                                    class="form-check-input" 
                                                    required
                                                >
                                                <label class="form-check-label" for="customRadio_{{ $option->id }}">
                                                    {{ $option->offered_answer }}
                                                </label>
                                            </div>
                                        @endforeach
                                        <div class="mt-2">
                                            <label for="feedback_{{ $item->id }}" class="form-label">
                                                Feedback <span class="text-danger">*</span>
                                            </label>
                                            <textarea 
                                                name="feedback[{{ $item->id }}]" 
                                                id="feedback_{{ $item->id }}" 
                                                class="form-control" 
                                                rows="2" 
                                                placeholder="Provide your feedback..." 
                                                required
                                            ></textarea>
                                        </div>
                                    </div>

                                    @php $i++; @endphp

                                    @if (($index + 1) % 5 === 0 || $index + 1 === count($survey->question))
                                        <!-- Close the section -->
                                        </div>
                                    @endif
                                @endforeach

                                <div class="text-end btn-mb">
                                    <a href="{{ route('index') }}" class="btn btn-secondary text-white">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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

@endsection
