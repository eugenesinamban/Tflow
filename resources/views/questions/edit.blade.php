@extends('layouts.app')

@section('content')
    <a href="{{ action("QuestionsController@show", $question->id) }}" class="btn btn-light">Back</a>
    <hr>
    <h1>Edit question</h1>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{action('QuestionsController@update', $question->id)}}" method="post">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <input type="text" class="form-control @error('question_title') is-invalid @enderror" name="question_title" id="question_title" placeholder="Question Title" value="{{ $question->question_title }}">

                            @error('question_title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea class="form-control @error('question_body') is-invalid @enderror" name="question_body" id="question_body" placeholder="Enter Question Here">{{ $question->question_body }}</textarea>

                            @error('question_body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="tag">Tags :</label>
                            <input type="text" name="tag" id="tag" class="form-control @error('tag') is-invalid @enderror" value="{{ $tags }}">

                            @error('tag')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
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
