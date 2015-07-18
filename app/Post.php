<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	protected $fillable = ['title', 'group_id', 'message', 'url', 'user_id'];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
