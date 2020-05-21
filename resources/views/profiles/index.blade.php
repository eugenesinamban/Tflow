@extends('layouts.app')

@section('content')
    @include('include.back')
    <h2>Profile</h2>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm">
                    <div class="card w-100" style="max-width: 20rem;">
                        <img src="{{ $url . $profile->profile_image }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <h6 class="card-subtitle text-muted">{{ $user->username }} | 登録日時 {{ $user->created_at }}</h6>
                            <strong class="card-text mt-3">ステータス:</strong>
                            <p class="card-text">{{ $profile->details }}</p>
                            <a href="{{ $profile->url }}" class="card-link" @if ($profile->url !== "#") target="_blank" @endif>{{ $profile->url === "#" ? 'No entry' : $profile->url}}</a>
                        </div>
                        @can('update', $profile)
                        <div class="card-footer d-flex justify-content-center">
                            <a href="{{ '/profile/'. $user->profile->id . '/edit' }}" class="btn btn-primary">プロフィール編集</a>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-body">
                        <h2 class="card-text">
                            ユーザー詳細
                        </h2>
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>ワールド</th>
                                <td>{{ $user->course->field->name }}</td>
                            </tr>
                            <tr>
                                <th>専攻</th>
                                <td>{{ $user->course->name }}</td>
                            </tr>
                            <tr>
                                <th>年</th>
                                <td>{{ $user->year }}</td>
                            </tr>
                            <tr>
                                <th>自己紹介：</th>
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
