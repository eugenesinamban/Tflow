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
                        @include('include.questionForm')

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
