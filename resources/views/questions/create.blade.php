@extends('layouts.app')

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    <hr>
    <h1>Ask a question!</h1>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{action('QuestionsController@store')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <input type="text" class="form-control @error('question_title') is-invalid @enderror" name="question_title" id="question_title" placeholder="Question Title">

                            @error('question_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea class="form-control @error('question_body') is-invalid @enderror" name="question_body" id="question_body" placeholder="Enter Question Here"></textarea>

                            @error('question_body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group mt-4">
                            <label for="tag">Tags</label>
                            <input type="text" class="form-control @error('tag') is-invalid @enderror" name="tag" id="tag" placeholder="Enter tags here and separate them with commas">

                            @error('tag')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
