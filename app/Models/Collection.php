<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Artifact;
use User;

class Collection extends Model
{

     /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['title','description'];

    protected $dates = [
        'created_at','updated_at',
    ];

	//protected $dateFormat = 'U';
     public function curators()
    
    {
         return $this->belongsToMany('App\Models\User')->withPivot('position');
    }

    public function artifacts()
    {
         
         // testing using a model on the pivot table artifact_collection

         // return $this->belongsToMany(Artifact::class)->using('App\Label')->withPivot('position','title','medium','year','dimensions_height','dimensions_width','dimensions_depth','dimensions_units')->orderBy('position', 'asc');

         return $this->belongsToMany('App\Models\Artifact')->withPivot('position','artist','title','medium','year','position','dimensions_height','dimensions_width','dimensions_depth','dimensions_units','label_text')->orderBy('position', 'asc');
    }

}