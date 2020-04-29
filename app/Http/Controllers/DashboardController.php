<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $questions = auth()->user()->questions;
        return view('dashboard.index', compact('questions'));
    }

    public function deactivate()
    {
        $this->authorize('delete', auth()->user());
        return view('dashboard.deactivate');
    }
}
