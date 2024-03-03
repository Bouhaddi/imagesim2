<?php

namespace App\Domain\Pages\Contracts;

interface PagesRepositoriesInterface
{
    public function all();
    public function create($pageData);

    public function find($pageId);

    public function update($pageId, $pageData);

    public function delete($pageId);
}
