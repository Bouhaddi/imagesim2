<?php

namespace App\Domain\Posts\Contracts;

interface PostsRepositoryInterface
{
    public function all();

    public function create($postData);
    public function find($postId);
    public function update($postId, $postData);
    public function destroy($postId);
}
