<?php namespace App\Http\Administrator;


use App\User;

class AdministratorRepository {

    /**
     * @param $group
     * @param $user
     */
    public function createAdmin($group, $user)
    {
        $group->administrators()->attach($user->id);
    }

    /**
     * @param $group
     * @param $user
     */
    public function deleteAdmin($group, $user)
    {
        $group->administrators()->detach($user->id);
    }

    /**
     * @param $value
     * @param int $howMany
     * @return mixed
     */
    public function searchedUsers($value, $howMany =10)
    {
        return User::searchFor('firstName', $value)->paginate($howMany);
    }

    public function searchedGroupUsers($group, $value, $howMany =10)
    {
        return $group->followers()->searchFor('firstName', $value)->paginate($howMany);
    }
} 