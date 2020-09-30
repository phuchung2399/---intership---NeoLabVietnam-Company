<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    /**
     * @var $roleRepository
     */
    protected $roleRepository;

    /**
     * BorrowService constructor.
     * 
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get all borrow.
     * 
     * @return String
     */
    public function getAll()
    {
        return $this->roleRepository->getAll();
    }

    /**
     * Validate role data.
     * 
     * Store to DB if there are no errors.
     * 
     * @param array $data
     * @return String
     */
    public function save($data)
    {
        return $this->roleRepository->create($data);
    }

       /**
     * Update role data
     * Store to DB if there are no errors.
     * 
     * @param array $data
     * @param $id
     * @return String
     */
    public function update($data, $id)
    {
        return $this->roleRepository->update($data, $id);
    }
}
