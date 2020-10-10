<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Section;
use Component;

class Assignment extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'section_id',
    ];

     public function components()
    {
            return $this->hasMany('App\Models\Component')->orderBY('date_due');
    }

     public function course()
    {
            return $this->belongsTo('App\Models\Course');
    }

    public function section()
    {
            return $this->belongsTo('App\Models\Section');
    }

    public function site()
    {
            return $this->belongsTo('App\Models\Site');
    }
}
