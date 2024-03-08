<?php

namespace App\Domain\Posts\Controllers;

use App\Domain\Posts\Requests\PostsRequests;
use App\Domain\Posts\Services\PostsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class PostsController extends Controller
{
    public PostsService $postService;

    public function __construct(PostsService $postService)
    {
        $this->postService = $postService;
    }
    public function index(): JsonResponse
    {
        return response()->json($this->postService->allPosts());
    }

    public function store(PostsRequests $request): JsonResponse
    {
        $newBlog = $this->postService->createPost($request->all());

        if(!$newBlog){
            return response()->json(["error" => "Failed to create a new post"], 422);
        }

        return response()->json(['message' => 'Your new post has been successfully created.', 'data' => $newBlog], 201);
    }

    public function show($postId): JsonResponse
    {
        $post = $this->postService->findPost($postId);

        if(!$post){
            return response()->json(["Post Not Found"], 404);
        }

        return response()->json($post);
    }

    public function update(PostsRequests $request, $postId)
    {
        $post = $this->postService->updatePost($postId, $request->all());

        if(!$post){
            return response()->json(['error' => 'Post not Found'], 404);
        }

        return response()->json($post);
    }

    public function destroy($postId)
    {
        $deleted = $this->postService->deletePost($postId);

        if(!$deleted){
            return response()->json(['error' => 'Post not found'], 404);
        }

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
