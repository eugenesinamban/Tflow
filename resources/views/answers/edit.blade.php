@extends('layouts.app')

@section('content')
    <h3>質問</h3>
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
                質問者 <a href="{{ action('ProfilesController@show', $question->user->username) }}" class="card-link">{{ $question->user->username }}</a>
                作成日時 {{ $question->updated_at }}
            </small>
        </div>
    </div>

    <form action="{{ action('AnswersController@update', $answer->id) }}" method="post">

        @csrf
        @method('PATCH')

        @include('include.answerForm')

    </form>
@endsection
