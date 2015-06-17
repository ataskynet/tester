<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model {

	protected $fillable = ['group_id', 'user_id'];

    public function user()
    {
       return User::find($this->user_id);
    }

    public function group()
    {
        return Group::find($this->group_id);
    }

}
