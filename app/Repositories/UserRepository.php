<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    /**
     * @var $role
     */
    protected $user;

    /**
     * RoleRepository constructor.
     * 
     * @param User $model
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get all User.
     * 
     * @return User $user
     */
    public function getAll()
    {
        return $this->user->get();
    }

    /**
     * Get User by id
     * 
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->user->findOrFail($id);
    }

    /*
     * Save user
     * 
     * @param $data
     * @return user
     * 
    public function create($data)
    {
        return $this->user->create($data);
    }
     */

    /**
     * Update user
     * 
     * @param $data
     * @return user
     */
    public function update($data, $id)
    {
        $user = $this->user->findOrFail($id);
        $user->role_id = $data['role_id'];
        $user->update();
        return $user;
    }

    /**
     * temporarily locked
     * 
     * @param $id
     * @return String
     */
    public function destroy($id)
    {
        $user = $this->user->findOrFail($id);
        $user->active = false;
        $user->update();
        return $user;
    }

    /**
     * active user
     * 
     * @param $id
     * @return String
     */
    public function active($id)
    {
        $user = $this->user->findOrFail($id);
        $user->active = true;
        $user->update();
        return $user;
    }
}
