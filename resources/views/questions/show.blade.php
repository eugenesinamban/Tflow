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
                質問者 <a href="{{ action('ProfilesController@show', $question->user->username) }}" class="card-link">{{ $question->user->username }}</a>
            </h6>
            <small>
                作成日時{{ $question->created_at }} | 更新時 {{ $question->updated_at }}
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
                <a href="/tag/{{$tag->name}}" class="btn-sm btn-light mr-2">{{ $tag->name }}</a>
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
    @include('answers.show')

    @can('create', [\App\Answer::class, $question])
        @include('answers.create')
    @endcan




@endsection
