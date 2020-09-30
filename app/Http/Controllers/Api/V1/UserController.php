<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    protected $userService;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection($this->userService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return UserResource
     */
    public function update(Request $request, $id)
    {
        $data = $request->only(['role_id']);
        try {
            return (new UserResource($this->userService->update($data, $id)))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
        } catch (\Exception $ex) {
            abort(500, 'Could not update user or assign it to administrator');
        }
    }

    /**
     * temporarily locked
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return (new UserResource($this->userService->destroy($id)))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
        } catch (\Exception $ex) {
            abort(500, 'Could not delete user or assign it to administrator');
        }
    }

    /**
     * active user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        try {
            return (new UserResource($this->userService->active($id)))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
        } catch (\Exception $ex) {
            abort(500, 'Could not active user or assign it to administrator');
        }
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        return (new UserResource($user))->response()->setStatusCode(200);
    }
}
