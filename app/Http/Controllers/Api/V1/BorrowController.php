<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BorrowRequest;
use Illuminate\Http\Request;
use App\Http\Resources\Borrow as BorrowResource;
use App\Http\Resources\BorrowCollection;
use App\Services\BorrowService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BorrowController extends Controller
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
     * @return App\Http\Resources\BorrowCollection
     */
    public function index()
    {
        // return new BorrowCollection($this->borrowService->getAll());
        return BorrowResource::collection($this->borrowService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\BorrowRequest  $request
     * @return App\Http\Resources\Borrow
     */
    public function store(BorrowRequest $request)
    {
        $request->validated();
        try {
            return (new BorrowResource($this->borrowService->save($request)))->response()->setStatusCode(201);
        } catch (Exception $ex) {
            abort(500, 'Could not create Borrow or assign it to administrator');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\Borrow
     */
    public function show($id)
    {
        $this->authorize('view', $this->borrowService->getById($id));

        try {
            return (new BorrowResource($this->borrowService->getById($id)))->response()->setStatusCode(200);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'Not found resource');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\BorrowRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function accept($id)
    {
        try {
            return (new BorrowResource($this->borrowService->changeProgress($id, 1)))->response()->setStatusCode(202);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'Not found resource');
        }
    }

    public function cancel($id)
    {
        try {
            return (new BorrowResource($this->borrowService->changeProgress($id, 2)))->response()->setStatusCode(202);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'Not found resource');
        }
    }

    public function transfer($id)
    {
        try {
            return (new BorrowResource($this->borrowService->changeProgress($id, 3)))->response()->setStatusCode(202);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'Not found resource');
        }
    }

    public function returnAll($id)
    {
        try {
            return (new BorrowResource($this->borrowService->changeProgress($id, 4)))->response()->setStatusCode(202);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'Not found resource');
        }
    }
}
