@extends('layouts.app')

@section('content')
    @include('include.back')
    <div class="card">
        <div class="card-body">

            {{--question body--}}

            <h5 class="card-title">
                {{ $question->question_title }}
            </h5>
            <h6 class="card-subtitle mb-2">
                By <a href="{{ action('ProfilesController@show', $question->user->username) }}" class="card-link">{{ $question->user->username }}</a>
            </h6>
            <small>
                Created at {{ $question->created_at }} | Last updated at {{ $question->updated_at }}
            </small>
            <hr>
            <p class="card-text">
                {{ $question->question_body }}
            </p>
        </div>

        {{--tags--}}

        <div class="card-footer">
            <small class="card-text">Tags:
            @foreach($question->tags as $tag)
                <a href="#" class="btn-sm btn-light mr-2">{{ $tag->name }}</a>
            @endforeach
            </small>
        </div>

{{--        edit question       --}}

        @can('update', $question)
            <div class="card-footer d-flex justify-content-center">
                <a href="{{ '/questions/'. $question->id . '/edit' }}" class="btn btn-primary">Edit Question</a>
                <form action="{{ action('QuestionsController@destroy', $question->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger ml-3" value="Delete Question">
                </form>
            </div>
        @endcan
    </div>

{{--    answers     --}}

    @if(!empty($answers))
        @include('answers.show')
    @else
        <h3 class="mt-4">0 Answers</h3>
    @endif

    @auth
        @if(auth()->user()->id != $question->user->id)
            @include('answers.create')
        @endif
    @endauth

@endsection
