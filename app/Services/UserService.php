<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    /**
     * @var $roleRepository
     */
    protected $userRepository;

    /**
     * RoleService constructor.
     * 
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all user.
     * 
     * @return String
     */
    public function getAll()
    {
        return $this->userRepository->getAll();
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
        return $this->userRepository->update($data, $id);
    }

    /**
     * temporarily locked
     * 
     * @param $id
     * @return String
     */
    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }

    /**
     * temporarily locked
     * 
     * @param $id
     * @return String
     */
    public function active($id)
    {
        return $this->userRepository->active($id);
    }
}
