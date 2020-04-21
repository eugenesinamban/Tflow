@extends('layouts.app')

@section('content')
    <h3>Question to be answered</h3>
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">
                {{ $question->question_title }}
            </h4>
            <p class="card-text">
                {{ $question->question_body }}
            </p>
        </div>
        <div class="card-footer">
            <small>
                Asked by : <a href="{{ action('ProfilesController@show', $question->user->username) }}" class="card-link">{{ $question->user->username }}</a>
                on {{ $question->updated_at }}
            </small>
        </div>
    </div>

    <form action="{{ action('AnswersController@update', $answer->id) }}" method="post">

        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="answer" class="col-form-label">Edit Your Answer</label>
            <textarea name="answer" id="answer" cols="30" rows="10" class="form-control @error('answer') is-invalid @enderror">{{ old('answer') ?? $answer->answer }}</textarea>

            @error('answer')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary">
        </div>
    </form>
@endsection
