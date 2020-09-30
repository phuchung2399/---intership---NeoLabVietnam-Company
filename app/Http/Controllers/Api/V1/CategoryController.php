<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category as CategoryResource;
use App\Services\CategoryService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    /**
     * @var categoryService
     */
    protected $categoryService;

    /**
     * CategoryController Constructor
     * 
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection($this->categoryService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request->validated();

        try {
            return (new CategoryResource($this->categoryService->save($request)))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
        } catch (Exception $ex) {
            abort(500, 'Could not create Category or assign it to administrator');
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
            return (new CategoryResource($this->categoryService->getById($id)))->response()->setStatusCode(200);
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
    public function update(CategoryRequest $request, $id)
    {
        $request->validated();

        try {
            return (new CategoryResource($this->categoryService->update($request, $id)))->response()->setStatusCode(202);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'Not found resource');
        } catch (Exception $ex) {
            abort(500, 'Could not create office or assign it to administrator: ' . $ex);
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
            return (new CategoryResource($this->categoryService->deleteById($id)))->response()->setStatusCode(204);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'Not found resource');
        } catch (Exception $ex) {
            abort(500, 'Could not delete category or assign it to administrator: ' . $ex);
        }
    }

    public function uploadImage(Request $request, $id)
    {
        try {
            return (new CategoryResource($this->categoryService->uploadCategoryImg($request, $id)))->response()->setStatusCode(202);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'Not found resource');
        } catch (Exception $ex) {
            abort(500, 'Could not upload category image or assign it to administrator: ' . $ex);
        }
    }
}
