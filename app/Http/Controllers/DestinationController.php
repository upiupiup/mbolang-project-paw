<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Bookmark;

class DestinationController extends Controller
{
    public function index()
    {
        $mostVisit = Destination::whereIn('name', [
            'Pantai Tanjung Penyu',
            'Coban Rondo',
            'Pantai Tiga Warna',
            'Pantai Balekambang',
            'Gunung Kawi'
        ])->get();

        $randomDestinations = Destination::inRandomOrder()->take(4)->get();
        return view('welcome', compact('mostVisit', 'randomDestinations'));
    }

    public function list()
    {
        $destinations = Destination::all(); // Atau bisa pake paginate
        return view('destinations.index', compact('destinations'));
    }

    public function show($id)
    {
        $destination = Destination::findOrFail($id);

        $isBookmarked = false;
        if (auth()->check()) {
            $isBookmarked = Bookmark::where('user_id', auth()->id())
                                    ->where('destination_id', $id)
                                    ->exists();
        }

        return view('destination.show', compact('destination', 'isBookmarked'));
    }
}
