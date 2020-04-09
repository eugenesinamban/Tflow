@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ask a question!</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <form action="/questions" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="question_title" id="question_title" placeholder="Question Title">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="question_body" id="question_body" placeholder="Enter Question Here"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
</div>

@endsection
