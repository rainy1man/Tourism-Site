<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticket = Transaction::all();
        return response()->json($ticket);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ticket = Transaction::create($request->toArray());
        return response()->json($ticket);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Transaction::find($id);
        if(!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }
        return response()->json($ticket);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Transaction::find($id);
        if(!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }
        $ticket->update();
        return response()->json($ticket);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Transaction::find($id);
        if(!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }
        $ticket->delete();
        return response()->json(['message' => 'Ticket deleted successfully']);

    }
}
