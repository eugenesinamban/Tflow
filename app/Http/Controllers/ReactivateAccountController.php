<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\RedirectsUsers;

class ReactivateAccountController extends Controller
{
    use RedirectsUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reactivate()
    {
        return view('auth.reactivate');
    }

    public function authenticate(Request $request)
    {

        $data = $request->validate([
            $this->username() => ['required','string'],
            'password' => ['required','string']
        ]);

//        check if user is using an active account

        if (Auth::attempt($request->only($this->username(), 'password'))) {
            $this->sendLoginResponse($request);

        }

//        check if deactivated user credentials are valid

        $user = User::onlyTrashed()->where($this->username(), $data[$this->username()])->first();

        if (null !== $user && Hash::check($data['password'], $user->getAuthPassword())) {

            $this->restoreUser($user);

            $this->sendLoginResponse($request);

        }

        return $this->sendFailedLoginResponse($request);

    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        if ($response = $this->authenticated($request, Auth::guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect()->intended($this->redirectPath());
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
//        return redirect()->route('dashboard');
    }

    private function username()
    {
        $login = request()->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    /**
     * @param $user
     */
    private function restoreUser($user): void
    {
        $user->restore();
        $user->profile()->restore();
        $user->questions()->restore();
        $user->answers()->restore();
    }
}
