<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
class User extends Authenticatable implements Searchable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function($user) {

            // create a profile upon user registration

            $user->profile()->create([
                'profile_image' => 'images/noImage.png',
                'details' => 'No entries',
                'url' => '#'
            ]);
        });

    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->username);
    }
}
