<?php

namespace App\Domain\Categories\Controllers;

use App\Domain\Categories\Requests\CategoryRequest;
use App\Domain\Categories\Services\CategoriesService;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class CategoriesController extends Controller
{
    public CategoriesService $categoryService;

    public function __construct(CategoriesService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): JsonResponse
    {
        $categories = $this->categoryService->allCategories();

        return response()->json($categories);
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        try {
            $newCategory = $this->categoryService->createCategory($request->all());
            return response()->json($newCategory, 201); // 201 Created
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400); // 400 Bad Request or another appropriate status code
        }
    }

    public function show($categoryId): JsonResponse
    {
        try {
            $category = $this->categoryService->findCategory($categoryId);
            return response()->json($category);

        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }

    }

    public function update(CategoryRequest $request, $categoryId): JsonResponse
    {
        try {
            return $this->categoryService->updateCategory($categoryId, $request->all());
        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function destroy($categoryId): JsonResponse
    {
        try {
            $this->categoryService->deleteCategory($categoryId);
            return response()->json(['message' => 'Category has been deleted successfully']);

        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }


}
