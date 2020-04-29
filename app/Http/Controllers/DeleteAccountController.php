<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DeleteAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deleteAccount(User $user)
    {
        $this->authorize('forceDelete', $user);

        $user->forceDelete();
        return redirect('/')->with('success', 'Hope to see you again!');
    }
}
