<?php

namespace App\Services;

use App\Repositories\BorrowRepository;
use App\Repositories\DeviceRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Bridge\UserRepository;

class BorrowService
{
    /**
     * @var $borrowRepository
     */
    protected $borrowRepository;


    /**
     * BorrowService constructor.
     * 
     * @param BorrowRepository $borrowRepository
     */
    public function __construct(BorrowRepository $borrowRepository)
    {
        $this->borrowRepository = $borrowRepository;
    }

    /**
     * Get all borrow.
     * 
     * @return String
     */
    public function getAll()
    {
        return $this->borrowRepository->getAll();
    }

    /**
     * Get borrow by id
     * 
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->borrowRepository->find($id);
    }

    /**
     * Validate borrow data.
     * 
     * Store to DB if there are no errors.
     * 
     * @param array $data
     * @return String
     */
    public function save(Request $request)
    {
        DB::beginTransaction();
        try {

            // create borrow record
            $borrow = $this->borrowRepository->create([
                'user_id' => $request->user()->id,
                'project_name' => $request->project_name,
                'request_date' => Carbon::now(),
                'status' => false,
                'note' => isset($request->note) ? $request->note : null,

                'device_id' => $request->device_id,
                'start_date' => date('Y-m-d H:i:s', strtotime($request->start_date)),
                'end_date' => date('Y-m-d H:i:s', strtotime($request->end_date)),
            ]);

            DB::commit();

            return $borrow;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Change borrow status
     * 
     * @param $id
     * @param $status_number
     * @return mixed
     */
    public function changeProgress($id, $status_number)
    {
        $borrow = $this->borrowRepository->find($id);
        $borrow->status = $status_number;
        $borrow->update();

        return $borrow;
    }
}
