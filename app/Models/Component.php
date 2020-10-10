<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{

	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','assignment_id','date_due'
    ];
    
 //    public function getDates()
	// {
	// 	return ['created_at','updated_at','date_due'];
	

    protected $dates = [
        'created_at','updated_at','date_due',
    ];

    public function assignment()
    {
    	return $this->belongsTo('App\Models\Assignment');

    }

     public function section()
    {
        return $this->belongsToThrough('App\Models\Assignment','App\Models\Section');

    }

}
