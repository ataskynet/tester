<?php namespace App\Http\Share;


use App\Http\Mail\GroupMailer;
use App\Http\Traits\Postable;

class ShareRepository {

use Postable;
    /**
     * @var GroupMailer
     */
    private $groupMailer;

    /**
     * Constructor:
     * @param GroupMailer $groupMailer
     */
    function __construct(GroupMailer $groupMailer)
    {

        $this->groupMailer = $groupMailer;
    }

    public function share($file, $group, $user)
    {
        $this->createSharer($user, $group);
        $this->shareFile($file, $group);
        $message = 'New document: ' . $file->name . ' has been shared  by '.\Auth::user()->fullName();
        $url = '/share/'.$group->username.'/files/'.$user->id;
        $this->post($message, $group, $url);
        $this->groupMailer->sendFileSharedNotification($group,$file, $url);
        return $file;
    }

    public function createSharer($user, $group)
    {
        if(!($group->isASharer($user)))
        {
            $group->sharers()->attach($user->id);
            return true;
        }
        return false;
    }

    public function shareFile($file, $group)
    {
        $group->sharedFiles()->attach($file->id);
        return true;
    }

    public function sharedFiles($group, $user)
    {
        return $group->sharedFiles()->where('user_id', $user->id)->latest()->get();
    }
} 