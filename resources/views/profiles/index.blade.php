@extends('layouts.app')

@section('content')
    @include('include.back')
    <h2>Profile</h2>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm">
                    <div class="card w-100" style="max-width: 20rem;">
                        <img src="/storage/{{ $profile->profile_image }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <h6 class="card-subtitle text-muted">{{ $user->username }} | joined on {{ $user->created_at }}</h6>
                            <strong class="card-text mt-3">Details:</strong>
                            <p class="card-text">{{ $profile->details }}</p>
                            <a href="{{ $profile->url }}" class="card-link" @if ($profile->url !== "#") target="_blank" @endif>{{ $profile->url === "#" ? 'No entry' : $profile->url}}</a>
                        </div>
                        @can('update', $profile)
                        <div class="card-footer d-flex justify-content-center">
                            <a href="{{ '/profile/'. $user->profile->id . '/edit' }}" class="btn btn-primary">Edit Profile</a>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-body">
                        <h2 class="card-text">
                            User Details
                        </h2>
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Course</th>
                                <td>{{ $profile->course }}</td>
                            </tr>
                            <tr>
                                <th>Year</th>
                                <td>{{ $profile->year }}</td>
                            </tr>
                            <tr>
                                <th>About myself:</th>
                                <td>{{ $profile->about_myself }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection