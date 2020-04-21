<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{

    public $courses = [
        'スーパーゲームクリエイター専攻',
        'ゲームプログラマー専攻',
        'ゲームキャラクターデザイン専攻',
        'ゲーム企画・シナリオ専攻',
        'ゲームCGデザイン専攻',
        'スーパーITエンジニア専攻',
        'プログラマー専攻',
        'ロボット&IoT専攻',
        'スーパーデジタルメディア専攻',
        'コミックイラスト専攻',
        '総合アニメーション専攻',
        '国際ビジネスマネージメント専攻',
        'eSportsプロマネージメント専攻'
    ];

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
        $user = auth()->user();
        return view('profiles.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'details' => 'nullable',
            'url' => 'nullable',
            'profile_image' => 'required'
        ]);

        $imagePath = request()->file('profile_image')->store('profile_images', 'public');

        auth()->user()->profile()->create([
            'details' => $data['details'],
            'url' => $data['url'],
            'profile_image' => $imagePath
        ]);

        return redirect('/profile');

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

        $courses = $this->courses;

        return view('profiles.edit', compact(['profile', 'courses']));
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
            'profile_image' => 'max:1999',
            'about_myself' => 'min:10',
            'course' => 'string',
            'year' => 'integer'
        ]);



        if ($request->has('profile_image')) {
//            dd($request);
            $imagePath = request()->file('profile_image')->store('profile_images', 'public');

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
