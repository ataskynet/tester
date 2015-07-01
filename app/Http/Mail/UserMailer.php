<?php namespace App\Http\Mail;


use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class UserMailer {

    public function sendConfirmationMailTo($user, $code)
    {
        $data = [
            'name' => $user->firstName. ' ' . $user->lastName,
            'link' => url('/profile/activate/'. $code),
        ];


        return Mail::send('inspina.email.confirm', $data , function($message) use ($user)
        {
            $message->to($user->email, $user->firstName)->subject('Confirm your E-mail!');
        });
    }

    public function sendAddedAsSupervisorMail($user, $group)
    {
        $data = [
            'name' => $user->firstName. ' ' . $user->lastName,
            'link' =>  $group->username,
            'groupName' => $group->name,
        ];


        return Mail::send('inspina.email.addSupervisor', $data , function($message) use ($user)
        {
            $message->to($user->email, $user->firstName)->subject('Made supervisor of a skoolspace group');
        });
    }

    public function sendRemovedAsSupervisorMail($user, $group)
    {
        $data = [
            'name' => $user->firstName. ' ' . $user->lastName,
            'link' => '/groups/all',
            'groupName' => $group->name,
        ];


        return Mail::send('inspina.email.removeSupervisor', $data , function($message) use ($user)
        {
            $message->to($user->email, $user->firstName)->subject('Removed as supervisor of a skoolspace group');
        });
    }



} 