<?php

namespace App\Domain\Sections\Services;

use App\Domain\Sections\Contracts\SectionsRepositoryInterface;

class SectionsService
{
    public SectionsRepositoryInterface $sectionRepository;

    public function __construct(SectionsRepositoryInterface $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }

    public function allSections()
    {
        return $this->sectionRepository->all();
    }

    public function createSection($sectionData)
    {
        return $this->sectionRepository->create($sectionData);
    }

    public function findSection($sectionId)
    {
        return $this->sectionRepository->find($sectionId);
    }

    public function updateSection($sectionData, $sectionId)
    {
        return $this->sectionRepository->update($sectionData, $sectionId);
    }

    public function deleteSection($sectionId)
    {
        return $this->sectionRepository->delete($sectionId);
    }

}
