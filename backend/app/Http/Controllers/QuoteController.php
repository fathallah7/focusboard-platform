<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Gate;

class QuoteController extends Controller
{
    // Show a list of quotes with The count of reactions like and dislike 

    public function index()
    {
        $quotes = Quote::withCount([
            'reactions as like_count' => fn($q) => $q->where('reaction_type', 'like'),
            'reactions as dislike_count' => fn($q) => $q->where('reaction_type', 'dislike')
        ])->with('user')->latest()->get();

        return response()->json($quotes);
    }


    public function store(Request $request)
    {

        $request->validate([
            'quote' => 'required|string|max:255',
        ]);

        $quote = Quote::create([
            'quote' => $request->quote,
            'user_id' => $request->user()->id,
        ]);

        return response()->json(['message' => 'Quote created successfully', 'quote' => $quote], 201);
    }


    public function update(Request $request, Quote $quote)
    {
        Gate::authorize('update', $quote);

        $request->validate([
            'quote' => 'required|string|max:255',
        ]);

        $quote->update([
            'quote' => $request->quote,
        ]);

        return response()->json(['message' => 'Quote updated successfully', 'quote' => $quote]);
    }


    public function destroy(Request $request, Quote $quote)
    {
        Gate::authorize('destroy', $quote);

        $quote->delete();

        return response()->json(['message' => 'Quote deleted successfully']);
    }
}
