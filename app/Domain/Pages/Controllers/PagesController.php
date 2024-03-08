<?php

namespace App\Domain\Pages\Controllers;

use App\Domain\Pages\Requests\PageRequest;
use App\Domain\Pages\Services\PagesService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    public PagesService $pageService;

    public function __construct(PagesService $pageService)
    {
        $this->pageService = $pageService;
    }

    /**
     * Retrieve all pages.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $allPages = $this->pageService->allPages();

        return response()->json($allPages);
    }

    /**
     * Store a new page.
     *
     * @param  PageRequest  $request
     * @return JsonResponse
     */
    public function store(PageRequest $request): JsonResponse
    {
        $newPage = $this->pageService->createPage($request->all());

        if(!$newPage){
            return response()->json(["error" => "Failed to create a new page"], 422);
        }

        return response()->json(['message' => 'Your new page has been successfully created.', 'data' => $newPage], 201);
    }

    /**
     * Retrieve a specific page.
     *
     * @param  int  $pageId
     * @return JsonResponse
     */
    public function show($pageId): JsonResponse
    {
        $page = $this->pageService->findPage($pageId);

        if(!$page){
            return response()->json(["error" => "Page not Found"], 404);
        }

        return response()->json($page);
    }

    /**
     * Update a specific page.
     *
     * @param  PageRequest  $request
     * @param  int  $pageId
     * @return JsonResponse
     */
    public function update(PageRequest $request, $pageId): JsonResponse
    {
        $page = $this->pageService->updatePage($pageId, $request->all());

        if(!$page){
            return response()->json(['error' => 'Page not Found'], 404);
        }

        return response()->json($page);
    }

    /**
     * Delete a specific page.
     *
     * @param  int  $pageId
     * @return JsonResponse
     */
    public function destroy($pageId): JsonResponse
    {
        $deleted = $this->pageService->deletePage($pageId);

        if(!$deleted){
            return response()->json(['error' => 'Page not found'], 404);
        }

        return response()->json(['message' => 'Page deleted successfully']);
    }

}
