<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment = Comment::all();
        return response()->json($comment);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $comment = Comment::create($request->toArray());
        return response()->json($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::find($id);
        if(!$comment) {
            return response()->json(['message' => 'comment not found'], 404);
        }
        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment = Comment::find($id);
        if(!$comment) {
            return response()->json(['message' => 'comment not found'], 404);
        }
        $comment->update();
        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        if(!$comment) {
            return response()->json(['message' => 'comment not found'], 404);
        }
        $comment->delete();
        return response()->json(['message' => 'comment deleted successfully'], 404);
    }
}
