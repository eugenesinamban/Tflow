<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
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
        $searchResults = (new Search())
            ->registerModel(User::class, 'username')
            ->registerModel(Question::class, 'question_title', 'question_body')
            ->registerModel(Answer::class, 'answer')
            ->registerModel(Tag::class, 'name')
            ->perform($request->search);

        return view('search.results', compact(['searchResults', 'word']));
    }
}
