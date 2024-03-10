<?php

namespace App\Domain\Categories\Services;

use App\Domain\Categories\Contracts\CategoriesRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoriesService
{
    public CategoriesRepositoryInterface $categoryRepository;

    public function __construct(CategoriesRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function allCategories()
    {
        return $this->categoryRepository->all();
    }

    public function createCategory($categoryData)
    {
        $newCategory = $this->categoryRepository->create($categoryData);

        if(!$newCategory){
            throw new \Exception("Can't create new category");
        }

        return $newCategory;
    }

    public function findCategory($categoryId)
    {
        $category = $this->categoryRepository->find($categoryId);

        if(!$category) {
            throw new ModelNotFoundException("Category not found");
        }

        return $category;
    }

    public function updateCategory($categoryId, $categoryData)
    {
        $updateCategory = $this->categoryRepository->update($categoryId, $categoryData);

        if(!$updateCategory){
            throw new ModelNotFoundException("Can't update the category in questioon");
        }

        return $updateCategory;
    }

    public function deleteCategory($categoryId)
    {
        $deleteCategory = $this->categoryRepository->destroy($categoryId);

        if(!$deleteCategory) {
            throw new ModelNotFoundException("Cant find and delete the category in question");
        }

        return $deleteCategory;
    }

}
