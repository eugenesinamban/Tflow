@extends('layouts.app')

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    <hr>
    <h1>質問を聞きましょう</h1>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{action('QuestionsController@store')}}" method="post">
                        @csrf

                        @include('include.questionForm')
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
