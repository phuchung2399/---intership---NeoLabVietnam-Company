<?php

namespace App\Repositories;

use App\Borrow;
use App\Device;

class BorrowRepository
{
    /**
     * @var $borrow
     */
    protected $borrow;

    /**
     * BorrowRepository constructor.
     * 
     * @param Borrow $borrow
     */
    public function __construct(Borrow $borrow)
    {
        $this->borrow = $borrow;
    }

    /**
     * Get all borrows.
     * 
     * @return Array $borrows
     */
    public function getAll()
    {
        return $this->borrow->get();
    }

    /**
     * Get borrow by id
     * 
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->borrow->findOrFail($id);
    }

    /**
     * Save borrow
     * 
     * @param $data
     * @return Borrow
     */
    public function create($data)
    {
        return $this->borrow->create($data);
    }

    /**
     * Update device
     * 
     * @param $data
     * @return device
     */
    public function update($data, $id)
    {
        $borrow = $this->borrow->findOrFail($id);
        $borrow->project_name = $data['project_name'];
        $borrow->update();
        return $borrow;
    }
}
