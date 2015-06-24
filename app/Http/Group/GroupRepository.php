<?php namespace App\Http\Group;

use App\Group;

class GroupRepository {
    /**
     * @var Group
     */
    private $group;

    /**
     * @param Group $group
     */
    public function __construct(Group $group)
    {

        $this->group = $group;
    }

    public function isFollowerOf($group, $user)
    {
        $followerIds = $group->followers()->lists('user_id');

        foreach($followerIds as $follower)
        {
            if($user->id == $follower)
                return true;
        }

        return false;
    }

    public function searchedGroups($value, $howMany =10)
    {
        return Group::searchFor('name', $value)->paginate($howMany);
    }

    public function searchMyGroups($value, $user, $howMany =10 )
    {
        return $user->follows()->searchFor('name', $value)->paginate($howMany);
    }
} 