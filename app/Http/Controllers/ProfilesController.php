<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $profile = $user->profile;

        return view('profiles.index', compact(['user', 'profile']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->username == $id) {
            return redirect('/profile');
        }

        $user = User::where('username', $id)->firstOrFail();
        $profile = $user->profile;

        return view('profiles.index', compact(['user', 'profile']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Profile::find($id));

        $profile = Profile::find($id);

        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Profile::find($id));

        $data = $request->validate([
            'details' => 'nullable',
            'url' => ['url', 'nullable'],
            'profile_image' => ['max:1999', 'image'],
            'about_myself' => ['min:10', 'nullable'],
        ]);

        if ($request->has('profile_image')) {

            $image = request()->file('profile_image');
            $imagePath = Storage::disk('public')->put('profile_images', $image);

            $imageArray = ['profile_image' => $imagePath];
        };
        auth()->user()->profile->update(array_merge(

            $data,
            $imageArray ?? []

        ));

        return redirect('/profile')->with('success', 'Profile Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
