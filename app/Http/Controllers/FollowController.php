<?php namespace App\Http\Controllers;

use App\Group;
use App\Http\CLient\ClientRepository;
use App\Http\Group\GroupRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;
use App\Request as RequestClass;

class FollowController extends Controller {
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var GroupRepository
     */
    private $groupRepository;

    /**
     * @param ClientRepository $clientRepository
     * @param GroupRepository $groupRepository
     */
    public function __construct(ClientRepository $clientRepository, GroupRepository $groupRepository)
    {

        $this->clientRepository = $clientRepository;
        $this->groupRepository = $groupRepository;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $title = "Your Groups";
        $groups = $this->clientRepository->groupsForUser($this->user());
        return view('inspina.index.allGroups', compact('title', 'groups'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $title = 'Join a new group';
        $groups = Group::allPaginatedGroups();
        $tagline = "Join a New Group";
        return view('inspina.groups.search', compact('groups', 'title', 'tagline'));
	}

    /**
     * This stores a admission request for the new group
     * @param $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createRequest($group)
    {
        RequestClass::create([
            'group_id' => $group->id,
            'user_id' => \Auth::user()->id,
        ]);

        return redirect('/')->with('message', 'The admission request has been sent to '. $group->name .' administrator !');
    }

    public function storeRequest($request)
    {
        if(!($request->group()->isFollowedBy($request->user())))
        {
            $this->clientRepository->clientJoin($request->group(), $request->user());
            $request->delete();
            return redirect($request->group()->username)->with('message', 'The User has been added to this group.');
        }

        $request->delete();
        return redirect($request->group()->username);

    }

    /**
     * Store a newly created member for a public group.
     *
     * @param $group
     * @return Response
     */
	public function store($group)
	{
        if(!($group->isFollowedBy(\Auth::user())))
        {
            $this->clientRepository->clientJoin($group, $this->user());
        }

        return redirect($group->username);
	}

    /**
     * Display the specified resource.
     *
     * @param $group
     * @internal param int $id
     * @return Response
     */
	public function show($group)
	{
        $title = $group->name .' Members';
        $members = $this->clientRepository->paginatedMembersOfGroup($group);

        return view('inspina.followers.index', compact('members','title', 'group'));

	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $group
     * @internal param int $id
     * @return Response
     */
	public function destroy($group)
	{
        $this->clientRepository->clientLeave($group, $this->user());
        $this->flash('You have left the group: '.$group->name);
        return redirect('/');
	}

    public function destroyRequest($request)
    {
        $request->delete();
        return redirect()->back()->with('message', 'The user admission request has been deleted.');
    }

    public function getSearch($query)
    {
        $title = 'Join a new group';
        $groups = $this->groupRepository->searchedGroups($query);
        $tagline = 'Results('.$groups->count().') for "'.$query.'"';
        return view('inspina.groups.search', compact('groups', 'title', 'tagline'));
    }
    /**
     * * Funtion for searching through the group records.
     * @param SearchRequest $request
     * @return \Illuminate\View\View
     */
    public function search(SearchRequest $request)
    {

        return redirect('/group/'.$request->value.'/search/');
    }



}
