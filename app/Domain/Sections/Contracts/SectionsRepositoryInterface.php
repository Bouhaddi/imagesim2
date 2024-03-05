<?php

namespace App\Domain\Sections\Contracts;

interface SectionsRepositoryInterface
{
    public function all();

    public function create($sectionData);

    public function find($sectionId);

    public function update($sectionData, $sectionId);

    public function delete($sectionId);
}
