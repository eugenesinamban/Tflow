<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Field extends Model implements Searchable
{
    protected $fillable = ['name', 'search_index'];

    public function courses() {
        return $this->hasMany(Course::class);
    }

    public function users() {
        return $this->hasManyThrough(User::class, Course::class);
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->name);
    }
}
