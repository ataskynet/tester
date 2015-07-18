<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model {

	protected $fillable = ['forum_id', 'user_id', 'message'];

    public function forum()
    {
        return $this->belongsTo('App\Forum');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
