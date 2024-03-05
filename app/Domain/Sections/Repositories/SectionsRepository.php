<?php

namespace App\Domain\Sections\Repositories;

use App\Domain\Sections\Contracts\SectionsRepositoryInterface;
use App\Domain\Sections\Models\Section;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class SectionsRepository implements SectionsRepositoryInterface
{
    public Section $sectionModel;

    public function __construct(Section $sectionModel)
    {
        $this->sectionModel = $sectionModel;
    }

    public function all()
    {
        try {
            return $this->sectionModel->paginate();
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function create($sectionData)
    {
        try {
            return $this->sectionModel->create($sectionData);
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function find($sectionId)
    {
        try {
            $section = $this->sectionModel->find($sectionId);

            if(!$section){
                return null;
            }

            return $section;
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function update($sectionData, $sectionId)
    {
        try {
            $section = $this->sectionModel->find($sectionId);

            if(!$section){
                return null;
            }

            $section->fill($sectionData);
            $section->save();

            return $section;

        } catch(Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    public function delete($sectionId)
    {
        try {
            $section = $this->sectionModel->find($sectionId);

            if(!$section){
                return false;
            }

            $section->delete();

            return true;
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

}
