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

        @include('include.answerForm')

    </form>
@endsection
