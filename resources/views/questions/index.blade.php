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

    @include('include.questions')
@endsection
