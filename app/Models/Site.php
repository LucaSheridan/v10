<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use User;

class Site extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','nickname'
    ];

    /**
     * A site has many associated students.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany('App\Models\User')->role('student');
    }

        /**
     * A site has many associated users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        // return $this->belongsToMany(User::class);
        return $this->belongsToMany('App\Models\User');

    }

}
