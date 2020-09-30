<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Http\Resources\Role as RoleResource;
use App\Http\Controllers\Controller;

use App\Http\Resources\RoleCollection;

class RoleController extends Controller
{
    protected $roleService;

    function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new RoleCollection($this->roleService->getAll());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['role_name']);
        try {
            return (new RoleResource($this->roleService->save($data)))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
        } catch (\Exception $ex) {
            abort(500, 'Could not create role or assign it to administrator');
        }
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only(['role_name']);
        try {
            return (new RoleResource($this->roleService->update($data, $id)))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
        } catch (\Exception $ex) {
            abort(500, 'Could not create role or assign it to administrator');
        }
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
}
