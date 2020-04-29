<?php

namespace App\Http\Controllers;

use App\Course;
use App\Field;
use App\Question;
use App\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Global_;

class QuestionsController extends Controller
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
        $questions = Question::orderBy('created_at', 'DESC')->paginate(10);

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'question_title' => 'required',
            'question_body' => 'required',
            'tag' => 'nullable|min:3'
        ]);

        $tags = STR::of($data['tag'])->explode(', ');

//        remove tags
        array_pop($data);

//        create quesiton
        $question = auth()->user()->questions()->create($data);

//        attach tags
        foreach ($tags as $tag) {
            if ("" != $tag && "," != $tag && null != $tag && " " != $tag) {
                $tag = Tag::firstOrCreate(['name' => $tag]);

                $question->tags()->attach($tag->id);
            }
        }

        return redirect('/questions/')->with('success', 'Question added succesfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::findOrFail($id);
        $answers = $question->answers;

//        pass id thru session
        session(['question_id' => $id]);
        $label = 'Your Answer';

        return view('questions.show', compact(['question','answers', 'label']))->with('postId', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Question::find($id));
        $question = Question::find($id);
        $tags = $question->tags->implode('name', ', ');

        return view('questions.edit', compact(['question', 'tags']));
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
        $question = Question::find($id);

        $this->authorize('update', $question);

        $data = $request->validate([
            'question_title' => 'required',
            'question_body' => 'required',
            'tag' => 'string|nullable'
        ]);

        $tags = explode(', ', $data['tag']);

//        remove tags from request data
        array_pop($data);

//        update the question without the tags

        $question->update($data);

        $tagIds = [];

        foreach ($tags as $tag) {
            if ("" != $tag && "," != $tag && null != $tag && " " != $tag) {
                $tagIds[] = Tag::firstOrCreate(['name' => $tag])->id;
            }
        }

//        dd($tagIds);
//        sync tags
        $question->tags()->sync($tagIds);

        return redirect('/questions/' . $id)->with('success', 'Question edited successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('forceDelete', Question::find($id));

        Question::find($id)->forceDelete();

        return redirect('/questions')->with('success', 'Question Deleted Successfully');

    }

    public function tagView(Tag $tag)
    {

        $questions = $tag->questions()->orderBy('created_at', 'DESC')->paginate(10);

        $title = ' with tag "' . $tag->name . '"';

        return view('questions.index', compact(['questions', 'title']));
    }

    public function fieldView(Field $field)
    {
        $questions = Question::whereHas('user.course.field', function (Builder $query) use($field) {
            $query->where('name', '=', $field->name);
        })->orderBy('created_at', 'DESC')->paginate(10);

        $title = ' from : "' . $field->name . '"';

        return view('questions.field', compact(['questions', 'title', 'field']));
    }

    public function courseView(Course $course)
    {
        $questions = Question::whereHas('user.course', function (Builder $query) use ($course) {
           $query->where('name', '=', $course->name);
        })->orderBy('created_at', 'DESC')->paginate(10);

        $title = ' from : "' . $course->name . '"';

        return view('questions.course', compact(['questions', 'title', 'course']));
    }
}
