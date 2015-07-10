<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalFile extends Model {

    public $imageTypes = ['png', 'jpg', 'jpeg', 'jpe'];

    public $compressedTypes = [ 'zip', 'tar', 'rar', '7z', 'iso' ];

    public $excelTypes = ['xls', 'xlsm', 'xlsx', 'xlsb', 'xlt'];

    public $pptTypes = ['ppt','pptx','pptm','pot','potx'];

	protected $fillable = ['name', 'type', 'rand', 'source', 'folder_id', 'user_id'];

    public function folders()
    {
        return $this->belongsTo('App\PersonalFolder');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function isExcel()
    {
        foreach ($this->excelTypes as $type) {
            if($this->type == $type)
                return true;
        }

        return false;
    }

    public function isPpt()
    {
        foreach ($this->pptTypes as $type) {
            if($this->type == $type)
                return true;
        }

        return false;
    }

    public function isPdf()
    {
        if($this->type == 'pdf')
            return true;
        return false;
    }
    public function isDoc()
    {
        if($this->type == 'doc' || $this->type == 'docx')
            return true;
        return false;
    }

    public function isCompressedFile()
    {
        foreach ($this->compressedTypes as $type) {
            if($this->type == $type)
                return true;
        }

        return false;
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
