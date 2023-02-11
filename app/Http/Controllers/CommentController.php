<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return response()->json([
            'comments' => $comments
        ], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'required',
            'post_id' => 'required'
        ]);

        $comment = new Comment();
        $comment->body = $validatedData['body'];
        $comment->post_id = $validatedData['post_id'];
        $comment->user_id = Auth::id();
        $comment->save();

        return response()->json([
            'comment' => $comment,
            'message' => 'Comment created successfully!'
        ], 201);
    }

    public function show($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found!'
            ], 404);
        }

        return response()->json([
            'comment' => $comment
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'body' => 'required'
        ]);

        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found!'
            ], 404);
        }

        $comment->body = $validatedData['body'];
        $comment->save();

        return response()->json([
            'comment' => $comment,
            'message' => 'Comment updated successfully!'
        ], 200);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}

