<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','body','user_id'
    ];

     /**
     * A comment belongs  to an artifact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function artifact()
    {
        return $this->belongsTo('App\Models\Artifact');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
