<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Bookmark::updateOrCreate(
            ['user_id' => auth()->id(), 'destination_id' => $request->destination_id],
            ['category_id' => $request->category_id]
        );

        return response()->json(['message' => 'Bookmarked!']);
    }

    public function destroy(\App\Models\Bookmark $bookmark)
    {
        if ($bookmark->user_id !== auth()->id()) {
            abort(403);
        }

        $bookmark->delete();
        return back()->with('success', 'Bookmark berhasil dihapus.');
    }
}
