<?php namespace App\Http\Mail;


use Illuminate\Support\Facades\Mail;

class GroupMailer {

    public function sendFileUploadNotification($group,$file,$url)
    {
        $counter = 5;

        foreach($group->followers()->get() as $user)
        {
            if(!$group->isSupervisedBy($user))
            {
                $data = [
                    'name' => $user->fullName(),
                    'fileName' => $file->name,
                    'groupName' => $group->name,
                    'link' => $url,
                ];

                Mail::later($counter, 'inspina.email.new_file', $data, function($message) use ($user)
                {
                    $message->to($user->email, $user->fullName())->subject('New File Uploaded.');

                });

                $counter++;
            }
        }
    }

    public function sendFileSharedNotification($group, $file ,$url)
    {
        $counter = 5;

        foreach($group->followers()->get() as $user)
        {
            if(!$group->isSupervisedBy($user)) {
                $data = [
                    'name' => $user->fullName(),
                    'fileName' => $file->name,
                    'groupName' => $group->name,
                    'link' => $url,
                ];

                Mail::later($counter, 'inspina.email.new_file', $data, function ($message) use ($user) {
                    $message->to($user->email, $user->fullName())->subject('New File Shared.');

                });

                $counter++;
            }
        }
    }

    public function sendNewPinNotification($group, $notice ,$url)
    {
        $counter = 5;

        foreach($group->followers()->get() as $user)
        {
            if(!$group->isSupervisedBy($user) && $user->isMailable()) {
                $data = [
                    'name' => $user->fullName(),
                    'groupName' => $group->name,
                    'pinSender' => $notice->user()->first(),
                    'pinTitle' => $notice->title,
                    'link' => $url,
                ];

                Mail::later($counter, 'inspina.email.new_pin', $data, function ($message) use ($user) {
                    $message->to($user->email, $user->fullName())->subject('New Notice Pinned.');

                });

                $counter++;
            }
        }
    }


} 