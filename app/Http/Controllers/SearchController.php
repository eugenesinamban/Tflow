<?php

namespace App\Http\Controllers;

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
        $searchResults = (new Search())
            ->registerModel(User::class, 'username')
            ->registerModel(Question::class, 'question_title')
            ->registerModel(Tag::class, 'name')
            ->perform($request->search);

        return view('search.results', compact('searchResults'));
    }
}
