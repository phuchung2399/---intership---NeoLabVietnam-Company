<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Borrow as BorrowResource;
use App\Services\BorrowService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBorrowController extends Controller
{
    protected $borrowService;

    /**
     * BorrowController Constructor
     * 
     * @param BorrowService $borrowService
     */
    public function __construct(BorrowService $borrowService)
    {
        $this->borrowService = $borrowService;
        // $this->authorizeResource(\App\Borrow::class, 'borrow');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($request->exists('borrowstatus')) {
            return BorrowResource::collection($user->borrows()->where('status', $request->query('borrowstatus'))->orderBy('request_date', 'DESC')->get());
        }

        return BorrowResource::collection($user->borrows()->orderBy('request_date', 'DESC')->get());
    }
}
