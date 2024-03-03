<?php

namespace App\Domain\Pages\Repositories;

use App\Domain\Core\Traits\ContentTrait;
use App\Domain\Pages\Contracts\PagesRepositoriesInterface;
use App\Domain\Pages\Models\Page;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class PagesRepository implements PagesRepositoriesInterface
{
    use ContentTrait;
    private Page $pageModel;

    public function __construct(Page $pageModel)
    {
        $this->pageModel = $pageModel;
    }

    public function all()
    {
        try {
            return $this->pageModel->paginate();
        } catch (Exception $e) {
            // Log the error
            Log::error('Failed to fetch all pages: ' . $e->getMessage());

            // Return an error response
            return ['error' => 'Failed to fetch all pages'];
        }
    }

    public function create($pageData)
    {
        try {

            if(empty($pageData['slug'])){
                $pageData['slug'] = $this->generateUniqueSlug($pageData['title']);
            }

            return $this->pageModel->create($pageData);
        } catch(Exception $e) {
            Log::error('Failed to create a new page: '. $e->getMessage());
            return ['error' => 'Failed to create a new page :'. $e->getMessage()];
        }
    }

    public function find($pageId)
    {
        try {
            return $this->pageModel->find($pageId);
        } catch(Exception $e) {
            Log::error("Failed to look for the page: $pageId");

            return null;
        }
    }

    public function update($pageId, $pageData)
    {
        try {
            $page = $this->pageModel->find($pageId);

            if(!$page){
                return null;
            }

            $page->fill($pageData);
            $page->save();

            return $page;
        } catch(Exception $e) {
            Log::error("Failed to update the page: $pageId. Error: " . $e->getMessage());
            // You can return null here or throw an exception depending on your application's requirements
            return null;
        }
    }

    public function delete($pageId)
    {
        try {
            $page = $this->pageModel->find($pageId);

            if(!$page){
                return false;
            }

            $page->delete();

            return true;

        } catch(Exception $e) {
            Log::error("Failed to delete the page: $pageId. Error: " . $e->getMessage());
            return false;
        }
    }

    public function getModel(): string
    {
        return Page::class;
    }
}
