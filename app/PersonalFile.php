<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalFile extends Model {

    public $imageTypes = ['png', 'jpg', 'jpeg', 'jpe'];

	protected $fillable = ['name', 'type', 'rand', 'source', 'folder_id', 'user_id'];

    public function folders()
    {
        return $this->belongsTo('App\PersonalFolder');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function isImage()
    {
        foreach ($this->imageTypes as $type) {
            if($this->type == $type)
                return true;
        }

        return false;
    }

}
