<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * All fields are assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
