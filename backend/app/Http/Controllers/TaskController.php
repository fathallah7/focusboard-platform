<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->get();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        // Validate the request data
        $data = $request->validated();

        $task = $request->user()->tasks()->create($data);
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.  
     */
    public function show(Request $request, Task $task)
    {
        Gate::authorize('view', $task);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        Gate::authorize('update', $task);

        // Validate the request data
        $data = $request->validated();

        $task->update($data);
        return response()->json($task);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {
        Gate::authorize('delete', $task);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
