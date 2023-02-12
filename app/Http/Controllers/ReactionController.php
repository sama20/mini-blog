<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaction;

class ReactionController extends Controller
{
    public function store(Request $request, $postId)
    {
        $reaction = new Reaction();
        $reaction->user_id = auth()->user()->id;
        $reaction->post_id = $postId;
        $reaction->type = $request->input('type');
        $reaction->save();

        return response()->json([
            'message' => 'Reaction added successfully.'
        ], 201);
    }

    public function update(Request $request, $postId, $id)
    {
        $reaction = Reaction::find($id);
        $reaction->type = $request->input('type');
        $reaction->save();

        return response()->json([
            'message' => 'Reaction updated successfully.'
        ], 200);
    }

    public function destroy($postId, $id)
    {
        Reaction::destroy($id);

        return response()->json([
            'message' => 'Reaction deleted successfully.'
        ], 200);
    }
}
