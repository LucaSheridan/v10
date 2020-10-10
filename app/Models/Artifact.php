<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use User;
use Section;
use Assignment;
use Component;
use Comment;
use Collection;

class Artifact extends Model
{

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['medium','year'];

    protected $dates = [
        'created_at','updated_at','date_due',
    ];

    /**
     * An artifact was created by a user. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

     /**
     * An artifact may have been created as an assignment for a section. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
    
    /**
     * An artifact may have been created as an assignment for a section. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment');
    }

    /**
     * An artifact may belong to many collections.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function component()
    
    {
        return $this->belongsTo('App\Models\Component');
    }

    /**
     * An artifact may belong to many collections.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function collections()
    {
        // testing using a model on the pivot table artifact_collection

        // return $this->belongsToMany(Collection::class)->using('App\Label')->withPivot('position','description','dimensions_height','dimensions_width','dimensions_depth','dimensions_units');

        return $this->belongsToMany('App\Models\Collection')->withPivot('position','artist','title','medium','year','dimensions_height','dimensions_width','dimensions_depth','dimensions_units','label_text');

    }

    /**
     * An artifact can have many comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment')->orderBy('created_at', 'desc');
    }
    /**
     * Add a comment to the post.
     *
     * @param array $attributes
     */
    public function addComment($attributes)
    {
        $comment = (new Comment)->forceFill($attributes);
        $comment->user_id = auth()->id();
        
        return $this->comments()->save($comment);
    }
    
}



