<?php

namespace App\Domain\Categories\Repositories;

use App\Domain\Categories\Contracts\CategoriesRepositoryInterface;
use App\Domain\Categories\Models\Category;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\MockObject\Exception;

class CategoriesRepository implements CategoriesRepositoryInterface
{
    public $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    public function all()
    {
        try {
            return $this->categoryModel->all();
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function create($categoryData)
    {
        try {
            return $this->categoryModel->create($categoryData);
        } catch(Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    public function find($categoryId)
    {
        try {
            return $this->categoryModel->find($categoryId);
        } catch(\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    public function update($categoryId, $categoryData)
    {
        try {
            $category = $this->categoryModel->find($categoryId);

            if(!$category){
                return null;
            }

            $category->fill($categoryData);
            $category->save();

            return $category;

        } catch(\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    public function destroy($categoryId)
    {
        try {
            $category = $this->categoryModel->find($categoryId);

            if(!$category){
                return false;
            }

            $category->delete();

            return true;
        } catch(\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
