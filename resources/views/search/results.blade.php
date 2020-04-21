@extends('layouts.app')

@section('content')

    <h1>There are {{ $searchResults->count() }} results related to "{{ $word }}"</h1>

    @foreach($searchResults->groupByType() as $type => $model)
        <h2>{{ $type }}</h2>
        @foreach($model as $result)
            @switch($type)

                @case('users')
                    <h5><a href="/profile/{{ $result->searchable->username }}">{{ $result->searchable->username }}</a></h5>
                    @break

                @case('questions')
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5><a href="{{ "/questions/" . $result->searchable->id }}" class="card-link">{{ $result->searchable->question_title }}</a></h5>
                            <small class="card-text">{{ $result->searchable->question_body }}</small>
                        </div>
                        <div class="card-footer">
                            <small>Asked by <a href="/profile/{{ $result->searchable->user->username }}">{{ $result->searchable->user->username }}</a></small>
                        </div>
                    </div>
                    @break

                @case('tags')
                    <h5><a href="/tag/{{$result->searchable->name}}">{{ $result->searchable->name }}</a></h5>
                    @break

                @case('answers')
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5><a href="{{ "/questions/" . $result->searchable->question->id }}" class="card-link">{{ $result->searchable->question->question_title }}</a></h5>
                            <small class="card-text"><a href="/profile/{{ $result->searchable->user->username }}">{{ $result->searchable->user->username }}</a> : {{ $result->searchable->answer }}</small>
                        </div>
                        <div class="card-footer">
                            <small>Asked by <a href="/profile/{{ $result->searchable->question->user->username }}">{{ $result->searchable->question->user->username }}</a></small>
                        </div>
                    </div>
                    @break

                @default

            @endswitch
        @endforeach
        <hr>
    @endforeach
@endsection
