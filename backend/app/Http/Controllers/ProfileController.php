<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Return the authenticated user's profile information
        return response()->json(['user' => $request->user()], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password && $request->password_confirmation) {
            if ($request->password === $request->password_confirmation) {
                $user->password = bcrypt($request->password);
            } else {
                return response()->json(['error' => 'Password confirmation does not match.'], 422);
            }
        }

        $user->save();

        return response()->json(['user' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->delete();
            $user->tokens()->delete();
            return response()->json(['message' => 'User deleted successfully.'], 200);
        }
        return response()->json(['error' => 'User not found.'], 404);
    }
}
