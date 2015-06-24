<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalFolder extends Model {

	protected $fillable = ['name', 'sub_directory', 'folder_id', 'user_id'];

    public function isSubFolder()
    {
        if($this->sub_directory == NULL)
        {
            return false;
        }
        return true;
    }

    public function masterFolder()
    {
        return $this->belongsTo('App\PersonalFolder');
    }

    public function subFolders()
    {
        return $this->hasMany('App\PersonalFolder');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function files()
    {
        return $this->hasMany('App\PersonalFile');
    }
}
