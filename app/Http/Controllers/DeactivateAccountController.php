<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DeactivateAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        $user->profile()->delete();
        $user->questions()->delete();
        $user->answers()->delete();

        return redirect('/')->with('success', 'Hope to see you again soon!');
    }

}
