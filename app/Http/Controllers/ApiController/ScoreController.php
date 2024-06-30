<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $score = Score::all();
        return response()->json($score);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $score = Score::create($request->toArray());
        return response()->json($score);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $score = Score::find($id);
        if(!$score) {
            return response()->json(['message' => 'Score not found'], 404);
        }
        return response()->json($score);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $score = Score::find($id);
        if(!$score) {
            return response()->json(['message' => 'Score not found'], 404);
        }
        $score->update($request->toArray());
        return response()->json($score);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $score = Score::find($id);
        if(!$score) {
            return response()->json(['message' => 'Score not found'], 404);
        }
        $score->delete();
        return response()->json(['message' => 'Score deleted successfully']);
    }
}
