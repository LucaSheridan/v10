<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Artifact;
use App\Models\Collection;
use App\Models\Comment;
use App\Models\Site;
use App\Models\Section;

use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    
    public function getFullNameAttribute()
    {
        return ucfirst($this->firstName).' '.ucfirst($this->lastName);
    }

    public function getInitialsAttribute()
    {
        return substr( $this->firstName , 0 , 1).''.substr( $this->lastName , 0 , 1);
    }

     /**
     * A user may belong to multiple sites.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sites()
    {
        return $this->belongsToMany('App\Models\Site');
    }

    //  *
    //  * A user may belong to multiple sites.
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     
    // public function sections()
    // {
    //     return $this->belongsToMany('App\Section');
    // }  

     /**
     * A user may belong to multiple sections.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sections()
    {
        return $this->belongsToMany('App\Models\Section')->orderby('created_at', 'DESC');
    }

    /**
     * A user may belong to multiple active sections.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function activeSections()
    {
        return $this->belongsToMany('App\Models\Section')->where('is_active', 1 )->orderby('created_at', 'DESC');
    }

    /**
     * A user may belong to multiple active sections.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function inactiveSections()
    {
        return $this->belongsToMany('App\Models\Section')->where('is_active', 0 )->orderby('created_at', 'DESC');
    }

    /*
     * A user may post multiple comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

     /*
     * A user may create multiple collections.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function collections()
    {
        return $this->belongsToMany('App\Models\Collection')->withPivot('position')
        ->orderBy('position');
    }

}
