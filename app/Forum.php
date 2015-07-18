<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model {

	protected $fillable = ['group_id', 'title', 'user_id'];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function posts()
    {
        return $this->hasMany('App\ForumPost');
    }
}
