@extends('layouts.app')

@section('content')
    <a href="#" class="btn btn-light mb-4">Back</a>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mt-2">Edit Profile</h3>
        </div>
        <div class="card-body">
            <form action="{{ action('ProfilesController@store') }}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="details">Details</label>
                    <input type="text" name="details" id="details" class="form-control @error('details') is-invalid @enderror " value="{{ old('details') }}">

                    @error('details')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror " value="{{ old('url') }}">

                    @error('url')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="image">Profile Image</label>
                    <input type="file" name="profile_image" id="image" class="form-control-file">

                    @error('profile_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <hr>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
@endsection
