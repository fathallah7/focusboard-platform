<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\QuoteReaction;
use Illuminate\Http\Request;

class QuoteReactionController extends Controller
{

    public function store(Request $request, Quote $quote)
    {

        $data = $request->validate([
            'reaction_type' => 'required|in:like,dislike',
        ]);

        $reaction = QuoteReaction::updateOrCreate([
            'user_id' => $request->user()->id,
            'quote_id' => $quote->id,
        ]);

        return response()->json(['message' => 'Reaction saved', 'reaction' => $reaction]);
    }


    public  function destroy(Request $request, Quote $quote)
    {

        $reaction = QuoteReaction::where('user_id', $request->user()->id)
            ->where('quote_id', $quote->id)
            ->first();

        if (!$reaction) {
            return response()->json(['message' => 'Reaction not found'], 404);
        }

        $reaction->delete();

        return response()->json(['message' => 'Reaction removed']);
    }



}
