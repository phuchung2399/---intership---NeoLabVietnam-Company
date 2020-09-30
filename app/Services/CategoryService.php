<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    /**
     * @var $categoryRepository
     */
    protected $categoryRepository;

    /**
     * ModelService constructor.
     * 
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get all category.
     * 
     * @return String
     */
    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Get category by id
     * 
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->categoryRepository->find($id);
    }

    /**
     * Validate category data.
     * 
     * Store to DB if there are no errors.
     * 
     * @param Request $request
     * @return String
     */
    public function save(Request $request)
    {
        try {

            $category = $this->categoryRepository->create([
                'category_name' => $request->category_name,
                'description' => isset($request->description) ? $request->description : null,
                'image' => isset($request->image) ? $this->uploadImg($request) : null
            ]);

            return $category;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update category data
     * Store to DB if there are no errors.
     * 
     * @param array $data
     * @param $id
     * @return String
     */
    public function update(Request $request, $id)
    {
        try {
            $category = $this->categoryRepository->update($request, $id);

            return $category;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Delete category by id
     * 
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        $category = $this->categoryRepository->find($id);
        if ($this->deleteImage($category->image)) {
            return $this->categoryRepository->delete($id);
        }
    }

    /**
     * Update image for category by id
     * 
     * @param Request $request
     * @param $id
     * @return String
     */
    public function uploadCategoryImg(Request $request, $id)
    {
        try {
            $category = $this->categoryRepository->find($id);

            if ($this->deleteImage($category->image)) {

                $category->image = $this->uploadImg($request);

                $category->save();
            }

            return $category;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function uploadImg(Request $request)
    {
        try {
            $file = $request->file('image');

            $path = Storage::putFile('public/upload/category-images', $file);

            return $path;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteImage($path)
    {
        try {
            if (Storage::exists($path)) {
                Storage::delete($path);
                return true;
            }
            return true;
        } catch (\Throwable $th) {
            throw $th;
            return false;
        }
    }
}
