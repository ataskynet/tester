<?php namespace App\Http\Controllers;

use App\Administrator;
use App\Http\Administrator\AdministratorRepository;
use App\Http\CLient\ClientRepository;
use App\Http\Mail\UserMailer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdministratorRequest;
use App\Http\Requests\SearchRequest;
use App\School;
use App\User;
use Auth;
use Validator;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;


class AdministratorController extends Controller {
    /**
     * @var Administrator
     */
    private $administrator;
    /**
     * @var AdministratorRepository
     */
    private $administratorRepository;
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var UserMailer
     */
    private $userMailer;


    /**
     * Create a new authentication controller instance.
     *
     * @param AdministratorRepository $administratorRepository
     * @param UserMailer $userMailer
     * @param ClientRepository $clientRepository
     * @internal param Administrator $administrator
     * @internal param Guard $auth
     * @internal param Registrar $registrar
     */
    public function __construct(AdministratorRepository $administratorRepository,UserMailer $userMailer, ClientRepository $clientRepository)
    {
        $this->administratorRepository = $administratorRepository;
        $this->clientRepository = $clientRepository;
        $this->userMailer = $userMailer;
    }

    public function index($group)
    {
        $title = $group->name . ' Administrators';
        $supervisors = $group->administrators()->get();
        $members = User::orderBy('firstName')->where('active', 1)->paginate(10);
        return view('inspina.administrators.index', compact('title','group', 'supervisors', 'members'));
    }

    public function store($group, $user)
    {
        if(!($group->isFollowedBy($user)))
        {
            $this->clientRepository->clientJoin($group, $user);
        }
        if(!$group->isSupervisedBy($user))
        {
            $this->administratorRepository->createAdmin($group, $user);
        }
        $this->userMailer->sendAddedAsSupervisorMail($user,$group);
        $this->flash('The user: '.$user->fullName().' has been added as a supervisor to '.$group->name);
        return redirect()->back();
    }

    public function destroy($group, $user)
    {
        $this->administratorRepository->deleteAdmin($group, $user);
        $this->clientRepository->clientLeave($group, $user);
        $this->userMailer->sendRemovedAsSupervisorMail($user,$group);
        $this->flash('The user: '.$user->fullName().' has been removed as a supervisor to '.$group->name);
        return redirect()->back();
    }

    /**
     * @param SearchRequest $searchRequest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @internal param $SearchRequest $
     */
    public function search(SearchRequest $searchRequest, $group)
    {
        return redirect($group->username.'/contacts/'.$searchRequest->value.'/search/');
    }

    /**
     * @param $group
     * @param $query
     * @return \Illuminate\View\View
     */
    public function getSearch($group, $query)
    {
        $title =  'Members searched: ' . $query;
        $members = $this->administratorRepository->searchedGroupUsers($group, $query);
        return view('inspina.followers.index', compact('title', 'group', 'members'));
    }

    public function show($group)
    {
        $title = $group->name . ' Administrators';
        $members = $group->administrators()->paginate(9);
        return view('inspina.administrators.list', compact('members', 'title', 'group'));
    }

}
