<?php namespace App\Http\Forum;

use App\Forum;
use App\ForumPost;
use App\Http\Traits\Postable;

class ForumRepository {

    use Postable;

    public function createForum($request, $group)
    {
        $forum = $group->forums()->create([
            'title' => $request->name,
            'user_id' => \Auth::user()->id,
        ]);

        $message = 'New Forum: ' . $request->name . ' created by '.\Auth::user()->firstName.' '.\Auth::user()->lastName;
        $url = $group->username.'/forums/ '.$forum->id;
        $this->post($message, $group, $url);

        return $forum;
    }

    public function createForumPost($forum, $request)
    {
        $post = $forum->posts()->create([
            'user_id' => \Auth::user()->id,
            'message' => $request->message,
        ]);

        $message = \Auth::user()->firstName.' '.\Auth::user()->lastName .' contributed to the '. $forum->title . ' forum';
        $url = $forum->group()->first()->username.'/forums/ '.$forum->id;
        $this->post($message, $forum->group()->first(), $url);

        return $post;
    }

} 