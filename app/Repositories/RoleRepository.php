<?php

namespace App\Repositories;

use App\Role;

class RoleRepository
{
    /**
     * @var $role
     */
    protected $role;

    /**
     * RoleRepository constructor.
     * 
     * @param Role $model
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Get all Roles.
     * 
     * @return Role $roles
     */
    public function getAll()
    {
        return $this->role->get();
    }

    /**
     * Get Role by id
     * 
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->role->findOrFail($id);
    }

    /**
     * Save User
     * 
     * @param $data
     * @return role
     */
    public function create($data)
    {
        return $this->role->create($data);
    }

    /**
     * Update user
     * 
     * @param $data
     * @return role
     */
    public function update($data, $id)
    {
        $role = $this->role->findOrFail($id);
        $role->role_name = $data['role_name'];
        $role->update();
        return $role;
    }
}
