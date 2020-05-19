@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('再登録お待ちしてます！') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('deactivate', auth()->user()) }}">

                @csrf
                @method('DELETE')

                <div class="form-group row mt-2 mb-5">
                    <div class="col-md-8 offset-md-2">
                        {{ __('アカウントを無効したい場合はこちらで') }}
                        <button type="submit" class="btn btn-danger form-control">
                            {{ __('アカウント無効') }}
                        </button>
                    </div>
                </div>
            </form>
            <form action="{{ route('deleteAccount', auth()->user()) }}" method="POST">

                @csrf
                @method('DELETE')

                <div class="form-group row mt-2">
                    <div class="col-md-8 offset-md-2">
                        {{ __('アカウントを削除する場合はこちら') }}
                        <button type="submit" class="btn btn-danger form-control">
                            {{ __('アカウント削除') }}
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
