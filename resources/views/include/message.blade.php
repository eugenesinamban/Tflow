@if (session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
@endif
@auth
@if (!auth()->user()->hasVerifiedEmail())
    <div class="alert alert-danger mb-4 alert-dismissible fade show" role="alert">
        メールアドレスはまだ認証されてません！メールで<a href="{{ route('verification.notice') }}">認証</a>してください。
{{--        Your E-Mail address is not yet verified! <a href="{{ route('verification.notice') }}">Verify</a> it to enable asking and answering privileges!--}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@endauth
