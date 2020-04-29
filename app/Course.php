<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Course extends Model implements Searchable
{
    protected $fillable = [
      'name', 'field_id', 'search_index'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function field() {
        return $this->belongsTo(Field::class);
    }

    public function questions() {
        return $this->hasManyThrough(Question::class,User::class);
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->name);
    }
}
