<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'details', 'profile_image', 'url', 'year', 'course', 'about_myself'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
