<?php namespace App\Http\Mail;


use Illuminate\Support\Facades\Mail;

class GroupMailer {

    public function sendFileUploadNotification($group,  $url)
    {
        $counter = 5;

        foreach($group->followers()->get() as $user)
        {
            $data = [
                'name' => $user->fullName(),
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