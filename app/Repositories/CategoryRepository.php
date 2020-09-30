<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository
{
    /**
     * @var Category
     */
    protected $category;

    /**
     * CategoryRepository constructor.
     * 
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get all category.
     * 
     * @return Category $category
     */
    public function getAll()
    {
        return $this->category->with('devices')->get();
    }

    /**
     * Get category by id
     * 
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->category->findOrFail($id)->loadMissing('devices');
    }

    /**
     * Save Category
     * 
     * @param $data
     * @return mixin
     */
    public function create($data)
    {
        return $this->category->create($data);
    }

    /**
     * Update Category
     * 
     * @param $data
     * @return mixin
     */
    public function update($data, $id)
    {
        $category = $this->category->findOrFail($id);

        $category->category_name = $data['category_name'];
        $category->description = $data['description'];

        $category->update();

        return $category;
    }

    /**
     * Delete Category
     * 
     * @param $id 
     * @return mixin
     */
    public function delete($id)
    {
        $category = $this->category->findOrFail($id);

        $category->delete();

        return $category;
    }

    /**
     * Restore Category
     * 
     * @param $id
     * @return mixin
     */
    public function restore($id)
    {
        $category = $this->category->withTrashed()->find($id);
         $category->restore(); 
        return $category; 
    }
}
