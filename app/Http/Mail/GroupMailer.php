<?php namespace App\Http\Mail;


use Illuminate\Support\Facades\Mail;

class GroupMailer {

    public function sendFileUploadNotification($group, $file)
    {
        foreach($group->followers()->get() as $user)
        {
            $data = [
                'name' => $user->fullName(),
                'groupName' => $group->name,
            ];

            Mail::send('inspina.email.upload_file', $data, function($message) use ($user, $file)
            {
                $message->to($user->email, $user->fullName())->subject('New File has been shared.');

                $message->attach($file->source());
            });
        }
    }

    public function sendNewEventNotification($group,$event ,$link)
    {

            $data =  [
                'groupName' => $group->name,
                'event_name' => $event->name,
                'event_description' => $event->description,
                'link' => $link,
            ];

            Mail::send('inspina.email.new_event', $data, function($message) use ($group)
            {
                foreach($group->followers()->get() as $user)
                {
                    $message->to($user->email, $user->fullName())->subject('New Event Has Been Created.');
                }

            });
        }

} 