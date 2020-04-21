@extends('layouts.app')

@section('content')
    <h1>There are {{ $searchResults->count() }} results</h1>
    {{ dd($searchResults) }}
{{--    @foreach($searchResults as $result)--}}
{{--        {{ dd($result) }}--}}
{{--    @endforeach--}}
@endsection
