<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMovies extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_movies';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Get the user that clicked the movie.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
