<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'details', 'profile_image', 'url', 'year','field', 'course_id', 'about_myself'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
