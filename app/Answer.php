<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Answer extends Model implements Searchable
{
    protected $fillable = ['answer'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->answer);
    }
}
