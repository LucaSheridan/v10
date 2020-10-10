<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Site;
use User;
use Assignment;

class Section extends Model
{

   public function site()
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * A section may associate with a users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * A section may associated with many teachers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany('App\Models\User')->role('teacher');
    }

    /**
     * A section may associated with many students.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany('App\Models\User')->role('student')->orderBy('lastName', 'asc');
    }

        /**
     * A section meets at a specific educational site.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    // public function course()
    // {
    //     return $this->belongsTo(Course::class);
    // }

    /**
     * A stream has many posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    // public function posts()
    // {
    //     return $this->belongsToMany('App\Models\Assignment');
    // } 

    /**
     * A section has many assignments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function assignments()
    {
        return $this->hasMany('App\Models\Assignment');
    }
 }