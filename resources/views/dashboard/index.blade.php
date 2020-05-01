@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            @can('create', \App\Question::class)
            <div class="row justify-content-center mb-4">
                <div class="col-sm text-center">
                    <h4 class="mt-2">Go ahead and ask away!</h4>
                </div>
                <div class="col-sm text-center">
                    <a href="/questions/create" class="btn btn-primary">Ask some question!</a>
                </div>
            </div>
            @endcan
            <div class="row justify-content-center">
                <div class="col text-center">
                    Number of questions asked : {{ auth()->user()->questions->count() }}
                </div>
                <div class="col text-center">
                    Number of answers: {{ auth()->user()->answers->count() }}
                </div>
            </div>
        </div>

    </div>

    <hr>

    @if($questions->count() > 0)

    <div class="mb-4">
        <h2>Questions asked so far</h2>
    </div>

    @endif
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
    <div class="card mt-5">
        <div class="card-body">
            <a href="{{ route('confirm') }}" class="card-link text-danger">Deactivate Account</a>
        </div>
    </div>
@endsection
