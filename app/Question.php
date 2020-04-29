<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Question extends Model implements Searchable
{
    use SoftDeletes;

    protected $fillable = [
        'question_title', 'question_body'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->question_title);
    }
}
