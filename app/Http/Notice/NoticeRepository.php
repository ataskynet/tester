<?php namespace App\Http\Notice;

use App\Http\Mail\GroupMailer;
use App\Notice;

use App\School;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Postable;


class NoticeRepository
{
    /**
     * @var GroupMailer
     */
    private $groupMailer;

    /**
     * @param GroupMailer $groupMailer
     */
    function __construct(GroupMailer $groupMailer)
    {

        $this->groupMailer = $groupMailer;
    }

    use Postable;


    public function createNotice ($request, $group)
	{
		$notice = $group->notices()->create(
			[
				'title' => $request->title,
				'message' => $request->message,
                'user_id' => \Auth::user()->id,
			]
		);

        $user = \Auth::user();
        $message = $user->firstName.' ' .$user->lastName . ' created a new Pin on ' .$group->name ;
        $url = $group->username . '/notice';
        $this->post($message , $group, $url);
        $this->groupMailer->sendNewPinNotification($group, $notice, $url);
	}

	public function pinsForSchool($group, $howMany = 8)
	{
		return Notice::where('group_id', $group->id)->latest()->paginate($howMany);
	}
}