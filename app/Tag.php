<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Tag extends Model implements Searchable
{

    protected $fillable = ['name'];

    public function questions() {
        return $this->belongsToMany(Question::class);
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->name);
    }
}
