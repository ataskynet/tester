<?php namespace App;

use App\Exceptions\SkoolspaceModelNotFoundException;
use Illuminate\Database\Eloquent\Model;
use App\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Group extends Model {

	protected $fillable = [ 'user_id',  'group_id', 'username', 'name', 'description', 'email', 'school_affiliation', 'type'];



    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function  followers()
    {
        return $this->belongsToMany('App\User', 'follows', 'group_id', 'user_id')->withTimestamps();
    }

    public function followersCount()
    {
        return $this->followers()->get()->count();
    }

    public function isFollowedBy($user)
    {
        $followersId = $this->followers()->lists('user_id');

        foreach($followersId as $followerId)
        {
            if($user->id == $followerId)
            {
                return true;
            }
        }

        return false;
    }

    public function events()
    {
        return $this->hasMany('App\Event');

    }

    public function notices()
    {
        return $this->hasMany('App\Notice');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }



    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function profileSource()
    {
        $profile = $this->hasOne('App\Profile')->first();
        if($profile != null)

            return $profile->source;
        return 'uploads/images/default/avatar.png';
    }

    public function folders()
    {
        return $this->hasMany('App\Folder');
    }

    public function isOwner($user)
    {
        if($this->user()->first()->id == $user->id)
            return true;
        return false;
    }

    public function paginatedPosts($howMany = 10)
    {
        return Post::where('group_id', $this->id)->latest()->simplePaginate($howMany);
    }

    public static function allPaginatedGroups($howMany = 10)
    {
        return self::simplePaginate($howMany);
    }

    public function mainFolders()
    {
        return $this->folders()->where('sub-directory', null)->get();
    }

    public static function scopeSearchFor($query, $field, $value)
    {
        return $query->where($field, 'LIKE', "%$value%");
    }

    public static function scopeFindOrFailByUsername($query, $username)
    {

        if($username == '')
            return null;
        $group = $query->where('username', $username)->first();

        if($group == null )
            throw (new SkoolspaceModelNotFoundException);
        return $group;
    }

    public function isPublic()
    {
        if($this->type == 1)
            return false;
        return true;
    }

    public function sentRequests()
    {
        return Request::where('group_id', $this->id)->get();
    }
}
