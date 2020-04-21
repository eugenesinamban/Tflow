@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-sm text-center">
                    <h4 class="mt-2">Go ahead and ask away!</h4>
                </div>
                <div class="col-sm text-center">
                    <a href="/questions/create" class="btn btn-primary">Ask some question!</a>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="mb-4">
        <h2>Questions asked so far</h2>
    </div>
    {{-- foreach comes in here --}}
    @foreach($questions as $question)
    <div class="card mb-2">
        <div class="card-header"></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="card-text mt-2">
                        <a href="{{ action('QuestionsController@show', $question->id) }}" class="card-link">
                            <span class="d-inline-block text-truncate" style="max-width: 20rem;">
                                {{ $question['question_title'] }}
                            </span>
                        </a>
                    </h4>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col">
                            <a href="{{ action('QuestionsController@edit', $question->id) }}" class="btn btn-primary form-control">
                                Edit
                            </a>
                        </div>
                        <div class="col">
                            <form action="{{ action('QuestionsController@destroy', $question->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger form-control" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <p class="card-text">
                <small>Asked on {{ $question->created_at }} | Last updated on {{ $question->updated_at }}</small>
            </p>
        </div>
    </div>
    @endforeach
@endsection
