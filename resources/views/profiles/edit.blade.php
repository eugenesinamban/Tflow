@extends('layouts.app')

@section('content')
    @include('include.back')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mt-2">Edit Profile</h3>
        </div>
        <div class="card-body">
            <form action="{{ action('ProfilesController@update', $profile->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="details">Details</label>
                    <input type="text" name="details" id="details" class="form-control @error('details') is-invalid @enderror " value="{{ old('details') ?? ($profile->details === 'No entries' ? '' : $profile->details) }}">

                    @error('details')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror " value="{{ old('url') ?? ($profile->url === '#' ? '' : $profile->url) }}">

                    @error('url')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="about_myself">About Myself</label>
                    <textarea name="about_myself" id="about_myself" class="form-control @error('about_myself') is-invalid @enderror ">{{ old('about_myself') ?? ($profile->about_myself === '#' ? '' : $profile->about_myself) }}</textarea>

                    @error('about_myself')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>


                <div class="form-group">
                    <label for="profile_image">Profile Image</label>
                    <small>Max size 2mb</small>
                    <input type="file" name="profile_image" id="profile_image" class="form-control-file @error('profile_image') is-invalid @enderror">
                    @error('profile_image')
                    <span class="invalid-feedback">
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
