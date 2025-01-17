<?php

namespace App\Http\Controllers;

use App\Models\ListeningHistory;
use Illuminate\Http\Request;

class ListeningHistoryController extends Controller
{
    public function index()
    {
        return ListeningHistory::all();
    }

    public function show($id)
    {
        return ListeningHistory::findOrFail($id);
    }

    public function store(Request $request)
    {
        $history = ListeningHistory::create($request->all());

        return response()->json($history, 201);
    }

    public function destroy($id)
    {
        $history = ListeningHistory::findOrFail($id);
        $history->delete();
        
        return response()->json(null, 204);
    }
}
