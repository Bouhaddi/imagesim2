<?php

namespace App\Domain\Sections\Controllers;

use App\Domain\Sections\Requests\SectionsRequest;
use App\Domain\Sections\Services\SectionsService;
use App\Http\Controllers\Controller;

class SectionsController extends Controller
{
    public SectionsService $sectionService;

    public function __construct(SectionsService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    public function index()
    {
        $sections = $this->sectionService->allSections();
        return response()->json($sections);
    }

    public function store(SectionsRequest $request)
    {
        $newSection = $this->sectionService->createSection($request->all());

        if(!$newSection){
            return response()->json(["error" => "Failed to create a new section"]);
        }

        return $newSection;
    }

    public function show($sectionId)
    {
        $section = $this->sectionService->findSection($sectionId);

        if(!$section){
            return response()->json(["error" => "sorry can't find the section in question"], 404);
        }

        return $section;
    }

    public function update(SectionsRequest $request, $sectionId)
    {
        return $this->sectionService->updateSection($request->all(), $sectionId);
    }

    public function destroy($sectionId)
    {
        $delete = $this->sectionService->deleteSection($sectionId);

        if(!$delete){
            return response()->json(["error" => "Sorry cant find or delete the section in question"], 404);
        }

        return response()->json(["Section has been deleted successfully"]);
    }
}
