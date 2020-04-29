@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <img src="/storage/{{ $field->field_image }}" alt="Banner" class="img-fluid mb-4">
        </div>
    </div>

    @include('include.questionHeader')

    @include('include.questions')

@endsection
