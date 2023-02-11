<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }

    public function index(): JsonResponse
    {
        return response()->json(Post::all(), 200);
    }


    public function store(Request $request): JsonResponse
    {
        $user = Auth::user();
        $post = new Post([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        $user->posts()->save($post);

        return response()->json(['post' => $post, 'message' => 'Post created successfully!'], 201);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json($post, 200);
    }

    public function update(Request $request,Post $post): JsonResponse
    {
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return response()->json(['post' => $post, 'message' => 'Post updated successfully!'], 200);
    }


    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully!'], 200);
    }
}
