<?php

namespace App\Http\Controllers;

use App\Models\DownloadHistory;
use Illuminate\Http\Request;

class DownloadHistoryController extends Controller
{
    public function index()
    {
        return DownloadHistory::all();
    }

    public function show($id)
    {
        return DownloadHistory::findOrFail($id);
    }

    public function store(Request $request)
    {
        $history = DownloadHistory::create($request->all());
        
        return response()->json($history, 201);
    }

    public function destroy($id)
    {
        $history = DownloadHistory::findOrFail($id);
        $history->delete();

        return response()->json(null, 204);
    }
}
