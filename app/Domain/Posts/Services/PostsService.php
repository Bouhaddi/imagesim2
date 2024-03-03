<?php

namespace App\Domain\Posts\Services;

use App\Domain\Posts\Contracts\PostsRepositoryInterface;
use App\Domain\Posts\Requests\PostsRequests;

class PostsService
{
    public PostsRepositoryInterface $postsRepository;

    public function __construct(PostsRepositoryInterface $postsRepository)
    {
        $this->postsRepository = $postsRepository;
    }

    public function allPosts()
    {
        return $this->postsRepository->all();
    }

    public function createPost($postData)
    {
        return $this->postsRepository->create($postData);
    }

    public function findPost($postId)
    {
        return $this->postsRepository->find($postId);
    }

    public function updatePost($postData, $postId)
    {
        return $this->postsRepository->update($postData, $postId);
    }

    public function deletePost($postId)
    {
        return $this->postsRepository->destroy($postId);
    }
}
