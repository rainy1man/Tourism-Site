<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Notfication;
use Illuminate\Http\Request;

class NotficationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notfication = Notfication::all();
        return response()->json($notfication);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $notfication = Notfication::create($request->toArray());
        return response()->json($notfication);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notfication = Notfication::find($id);
        if(!$notfication) {
            return response()->json(['message' => 'Notfication not found'], 404);
        }
        return response()->json($notfication);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $notfication = Notfication::find($id);
        if(!$notfication) {
            return response()->json(['message' => 'Notfication not found'], 404);
        }
        $notfication->update();
        return response()->json($notfication);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notfication = Notfication::find($id);
        if(!$notfication) {
            return response()->json(['message' => 'Notfication not found'], 404);
        }
        $notfication->delete();
        return response()->json(['message' => 'Notfication deleted successfully']);
    }
}
