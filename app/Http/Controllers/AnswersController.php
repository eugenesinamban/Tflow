<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AnswersController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postId = Question::find(\request('id'));
        return view('answers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate(['answer' => 'min:30']);

        $question_id = $request->session()->pull('question_id');
        $question = Question::find($question_id);

        $answer = new Answer();
        $answer->user()->associate(auth()->user());
        $answer->question()->associate($question);
        $answer->answer = $data['answer'];

        $answer->save();

        return redirect('/questions/' . $question_id)->with('success', 'Successfully added answer!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Answer::find($id));

        $answer = Answer::find($id);
        $question = $answer->question;

        session(['question_id' => $answer->question->id]);

        return view('answers.edit', compact(['answer', 'question']));
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
        $this->authorize('update', Answer::find($id));

        $data = $request->validate([
            'answer' => 'required'
        ]);

        $question_id = $request->session()->pull('question_id');
        $question = Question::find($question_id);

        $question->answers()->where('id',$id)->update($data);
//        Answer::find($id)->update($data);


        return redirect('/questions/' . $question_id)->with('success', 'Answer edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('update', Answer::find($id));

        Answer::find($id)->delete();

        return redirect(URL::previous())->with('success', 'Answer successfully deleted!');
    }
}
