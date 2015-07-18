<?php namespace App\Http\Controllers;

use App\Administrator;
use App\Client;
use App\course;
use App\Group;
use App\Http\Forum\ForumRepository;
use App\Http\Forum\ForumService;
use App\Http\Forum\Subject;
use App\Http\Mail\GroupMailer;
use App\Http\Requests\CreateForumPostRequest;
use App\Http\Requests\CreateForumRequest;
use App\School;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Commands\SendMessageComand;
use App\Http\Client\ClientRepository;


class ForumController extends Controller {
    /**
     * @var ForumRepository
     */
    private $repository;
    /**
     * @var GroupMailer
     */
    private $mailer;

    /**
     * @param ForumRepository $repository
     * @param GroupMailer $mailer
     */
    public function __construct(ForumRepository $repository, GroupMailer $mailer)
    {

        $this->repository = $repository;
        $this->mailer = $mailer;
    }

     public function index($group)
     {
         $title = $group->name . ' Forums';
         $forums = $group->forums()->latest()->paginate(10);

         return view('inspina.forum.index', compact('title','forums','group'));
     }

    public function create($group, CreateForumRequest $request)
    {
        $forum = $this->repository->createForum($request, $group);
        $url = $group->username.'/forums/'.$forum->id;
        $this->mailer->sendNewForumNotification($group, $forum, $url);
        return redirect($url);
    }

    public function show($group, $forum)
    {
        $title = $group->name." : ".$forum->title;
        $messages = $forum->posts()->get();

        return view('inspina.forum.view', compact('title', 'messages', 'group', 'forum'));
    }

    public function store($group, $forum, CreateForumPostRequest $request)
    {
        $this->repository->createForumPost($forum, $request);

        return redirect($group->username. '/forums/'.$forum->id);
    }

}
