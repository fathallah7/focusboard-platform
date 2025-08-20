<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // a controller for a dashboard read data numbers for the activities
    public function index(Request $request)
    {
        $user = $request->user();

        $tasksAllCount = $user->tasks()->count();
        $tasksCompletedCount = $user->tasks()->where('status', 'completed')->count();
        $tasksPendingCount = $user->tasks()->where('status', 'pending')->count();
        $tasksInprogressCount = $user->tasks()->where('status', 'in_progress')->count();

        $quotesAllCount = $user->quote()->count();

        $quotesLikesCount = $user->quoteReactions()->where('reaction_type', 'like')->count();
        $quotesDislikesCount = $user->quoteReactions()->where('reaction_type', 'dislike')->count();

        $analytics = [
            'tasks' => [
                'all' => $tasksAllCount,
                'completed' => $tasksCompletedCount,
                'pending' => $tasksPendingCount,
                'in_progress' => $tasksInprogressCount,
            ],
            'quotes' => [
                'all' => $quotesAllCount,
                'likes' => $quotesLikesCount,
                'dislikes' => $quotesDislikesCount,
            ],
        ];

        // user Quotes and each post likes and dislikes
        $quotes = $user->quote()->withCount([
            'reactions as like_count' => fn($q) => $q->where('reaction_type', 'like'),
            'reactions as dislike_count' => fn($q) => $q->where('reaction_type', 'dislike'),
        ])->get();


        return response()->json(
            [ 'analytics' => $analytics, 'content' => $quotes ]
        );
    }
}
