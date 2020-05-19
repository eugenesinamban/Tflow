@extends('layouts.app')

@section('content')
    <h1>There are {{ $searchResults->count() }} results related to "{{ request()->search }}"</h1>

    @foreach($searchResults->groupByType() as $type => $model)
        <h2>{{ $type }}</h2>

            @switch($type)

                @case('fields')
                    <div class="row">
                        @each('search.field', $model, 'result')
                    </div>
                @break

                @case('courses')
                    <div class="row">
                        @each('search.course', $model, 'result')
                    </div>
                @break

                @case('users')
                    <div class="row">
                        @each('search.user', $model, 'result')
                    </div>
                @break

                @case('questions')
                    @foreach($model as $result)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5><a href="{{ "/questions/" . $result->searchable->id }}" class="card-link">{{ $result->searchable->question_title }}</a></h5>
                                <small class="card-text">{{ $result->searchable->question_body }}</small>
                            </div>
                            <div class="card-footer">
                                <small>質問者：<a href="/profile/{{ $result->searchable->user->username }}">{{ $result->searchable->user->username }}</a></small>
                            </div>
                        </div>
                    @endforeach
                @break

                @case('tags')
                    @foreach($model as $result)
                        <h5><a href="/tag/{{$result->searchable->name}}" class="btn btn-light">{{ $result->searchable->name }}</a></h5>
                    @endforeach
                @break

                @case('answers')
                    @foreach($model as $result)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5><a href="{{ "/questions/" . $result->searchable->question->id }}" class="card-link">{{ $result->searchable->question->question_title }}</a></h5>
                                <small class="card-text"><a href="/profile/{{ $result->searchable->user->username }}">{{ $result->searchable->user->username }}</a> : {{ $result->searchable->answer }}</small>
                            </div>
                            <div class="card-footer">
                                <small>質問者<a href="/profile/{{ $result->searchable->question->user->username }}">{{ $result->searchable->question->user->username }}</a></small>
                            </div>
                        </div>
                    @endforeach
                @break

                @default

            @endswitch
        <hr>
    @endforeach
@endsection
