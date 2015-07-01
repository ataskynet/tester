<?php namespace App\Http\CLient;




use App\Client;
use App\Group;
use App\School;

/**
* 
*/
class ClientRepository
{
	
	function __construct()
	{
		
	}

    public function paginatedMembersOfGroup($group, $howMany = 9)
    {
        return $group->followers()->paginate($howMany);
    }

	Public function retrieveClient($school, $user)
	{
		return Client::where('username', $school->username)->where('user_id', $user->id)->first();
	}

    /**
     *  Returns all the groups in the system.
     * @param int $howMany
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allGroups($howMany =10)
	{
		return Group::simplePaginate($howMany);
	}

    /**
     * Returns all the groups the user has joined.
     * @param $user
     * @param int $howMany
     * @return mixed
     */
    public function groupsForUser($user, $howMany = 10)
	{
        $groupIds = $user->follows()->lists('group_id');

        $groups = Group::whereIn('id', $groupIds)->simplePaginate($howMany);

        return $groups;
	}

	public function clientJoin($group, $user)
	{
        if(!($group->isFollowedBy($user)))
        {
            $user->follows()->attach($group->id);
        }
        return $user;
	}

	public function clientsForUser($user)
	{
		return Client::where('user_id', $user->id)->get();
	}

    public function clientLeave($group, $user)
    {
        $user->follows()->detach($group->id);
    }


    public  function updateUser($request, $user)
    {
        $user->fill([
            'password' => ($request->password)? bcrypt($request->password):$user->password,
            'firstName' =>$request->firstName,
            'lastName' => $request->lastName,
            'telNumber' => $request->telNumber,
            'pin_notification' => $request->pin_notification,
        ])->save();
    }

    public function deactivateUser($user)
    {
        $groups = $user->follows()->get();

        $adminGroups = $user->administrates()->get();

        foreach($adminGroups as $group)
        {
            $user->administrates()->detach($group->id);
        }

        foreach($groups as $group)
        {
            $user->follows()->detach($group->id);
        }


        $user->active = 0;
        $user->code = str_random(90);
        $user->save();
        return $user;
    }
}