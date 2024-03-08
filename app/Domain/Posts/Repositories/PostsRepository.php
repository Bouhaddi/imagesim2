<?php

namespace App\Domain\Posts\Repositories;

use App\Domain\Core\Traits\ContentTrait;
use App\Domain\Posts\Contracts\PostsRepositoryInterface;
use App\Domain\Posts\Models\Post;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class PostsRepository implements PostsRepositoryInterface
{
    use ContentTrait;
    public Post $postModel;

    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    public function all()
    {
        try {
            return $this->postModel->paginate();
        } catch (Exception $e) {
            // Log the error
            Log::error('Failed to fetch all blog posts: ' . $e->getMessage());

            // Return an error response
            return null;
        }
    }

    public function create($postData)
    {
        try {

            if(empty($postData['slug'])){
                $postData['slug'] = $this->generateUniqueSlug($postData['title']);
            }

            return $this->postModel->create($postData);
        } catch(Exception $e) {
            Log::error('Failed to create a new page: '. $e->getMessage());

            return null;
        }
    }

    public function find($postId)
    {
        try {
            return $this->postModel->find($postId);
        } catch(Exception $e) {
            Log::error("Can't find the posts: $postId");
            return null;
        }
    }

    public function update($postId, $postData)
    {
        try {
            $post = $this->postModel->find($postId);

            if(!$post){
                return null;
            }

            if(empty($postData['slug'])){
                $postData['slug'] = $this->generateUniqueSlug($postData['title']);
            }

            $post->fill($postData);
            $post->save();

            return $post;

        } catch(Exception $e) {
            Log::error("Can't update the post: $postId");

            return null;
        }
    }

    public function destroy($postId)
    {
        try {
            $post = $this->postModel->find($postId);

            if(!$post){
                return false;
            }

            $post->delete();

            return true;
        } catch(Exception) {
            Log::error("Can't delete post id: $postId");
            return false;
        }
    }

    protected function getModel(): string
    {
        return Post::class;
    }
}
