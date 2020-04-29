<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Course;
use App\Field;
use App\Question;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
//use Spatie\Searchable\CourseSearchAspect;
//use Spatie\Searchable\FieldAndCourseSearchAspect;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $word = $request->search;

        if (null === $word) {
            return redirect(URL::previous())->with('error', 'Invalid Search Value');
        }

        if ('field' === Str::lower(Str::singular($word))) {
            $word = 'field';
        }

        if ('course' === Str::lower(Str::singular($word))) {
            $word = 'course';
        }

        $searchResults = (new Search())
            ->registerModel(Field::class, 'name', 'search_index')
            ->registerModel(Course::class, 'name', 'search_index')
            ->registerModel(User::class, 'username')
            ->registerModel(Question::class, 'question_title', 'question_body')
            ->registerModel(Answer::class, 'answer')
            ->registerModel(Tag::class, 'name')

            ->perform($word);

        return view('search.results', compact(['searchResults', 'word']));
    }
}
