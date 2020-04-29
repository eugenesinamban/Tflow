@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('It\'s Sad To See You Go..') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('deactivate', auth()->user()) }}">

                @csrf
                @method('DELETE')

                <div class="form-group row mt-2 mb-5">
                    <div class="col-md-8 offset-md-2">
                        {{ __('If you like to just deactivate your account, you may do so from here!') }}
                        <button type="submit" class="btn btn-danger form-control">
                            {{ __('Deactivate Account') }}
                        </button>
                    </div>
                </div>
            </form>
            <form action="{{ route('deleteAccount', auth()->user()) }}" method="POST">

                @csrf
                @method('DELETE')

                <div class="form-group row mt-2">
                    <div class="col-md-8 offset-md-2">
                        {{ __('If you like permanently delete your account, you may do it here!') }}
                        <button type="submit" class="btn btn-danger form-control">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
