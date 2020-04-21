@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-auto mr-auto">
            <h1>Questions{{ $title ?? "" }}</h1>
        </div>
        <div class="col-auto">
            <a href="{{ action('QuestionsController@create') }}" class="btn btn-primary">Add Question</a>
        </div>
    </div>
    <hr>

    @foreach($questions as $question)
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-text">
                <a href="{{ "/questions/" . $question->id }}" class="card-link">{{ $question['question_title'] }}</a>
            </h5>
        </div>
        <div class="card-footer">
            <h6 class="card-subtitle">
                Created by <a href="/profile/{{$question->user->username}}">{{ $question->user['username'] }}</a> | Created at {{ $question['created_at'] }}
            </h6>
        </div>
    </div>
    @endforeach
    {{ $questions->links() }}
@endsection
