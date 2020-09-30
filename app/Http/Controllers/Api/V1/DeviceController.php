<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceRequest;
use App\Http\Resources\Device as DeviceResource;
use App\Http\Resources\DeviceCollection;
use App\Services\DeviceService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    protected $deviceService;

    /**
     * DeviceController Constructor
     * 
     * @param DeviceService $deviceService
     */
    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DeviceCollection($this->deviceService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeviceRequest $request)
    {
        $request->validated();

        try {
            return (new DeviceResource($this->deviceService->save($request)))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
        } catch (Exception $ex) {
            abort(500, 'Could not create device or assign it to administrator');
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
        try {
            return (new DeviceResource($this->deviceService->getById($id)))->response()->setStatusCode(200);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'Not found resource');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeviceRequest $request, $id)
    {
        $request->validated();

        try {
            return (new DeviceResource($this->deviceService->update($request, $id)))->response()->setStatusCode(200);
        } catch (\Throwable $th) {
            throw $th;
        } catch (Exception $ex) {
            abort(500, 'Could not update device office or assign it to administrator');
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
        try {
            return (new DeviceResource($this->deviceService->deleteById($id)))->response()->setStatusCode(204);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'Not found resource');
        } catch (Exception $ex) {
            abort(500, 'Could not delete device or assign it to administrator: ' . $ex);
        }
    }

    public function uploadImage(Request $request, $id)
    {
        try {
            return (new DeviceResource($this->deviceService->uploadDeviceImg($request, $id)))->response()->setStatusCode(202);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'Not found resource');
        } catch (Exception $ex) {
            abort(500, 'Could not upload device image or assign it to administrator: ' . $ex);
        }
    }

    public function getRelated($id)
    {
        return DeviceResource::collection($this->deviceService->getRelatedById($id))->response()->setStatusCode(200);
    }
}
