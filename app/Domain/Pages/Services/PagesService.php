<?php

namespace App\Domain\Pages\Services;

use App\Domain\Pages\Contracts\PagesRepositoriesInterface;

class PagesService
{
    protected PagesRepositoriesInterface $pageRepository;

    public function __construct(PagesRepositoriesInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Method to fetch all pages paginated
     * @return mixed
     */
    public function allPages()
    {
        return $this->pageRepository->all();
    }

    /**
     * Create a new page in the database after passing $pageData
     * @param $pageData
     * @return mixed
     */
    public function createPage($pageData)
    {
        return $this->pageRepository->create($pageData);
    }

    /**
     * Find and return the page
     * @param $pageId
     * @return mixed
     */
    public function findPage($pageId)
    {
        return $this->pageRepository->find($pageId);
    }

    /**
     * Update a page by its $id
     * @param $pageId
     * @param $pageData
     * @return mixed
     */
    public function updatePage($pageId, $pageData)
    {
        return $this->pageRepository->update($pageId, $pageData);
    }

    /**
     * Hard delete a page from the database
     * @param $pageId
     * @return mixed
     */
    public function deletePage($pageId)
    {
        return $this->pageRepository->destroy($pageId);
    }



}
