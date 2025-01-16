<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Start with querying tasks by the logged-in user
        $query = Task::where('user_id', auth()->id());

        // Apply the status filter only if a specific status is selected
        if ($request->has('status') && $request->status !== '' && $request->status !== '1,0') {
            $query->where('status', $request->status);
        }


        // Apply sorting by due date if 'sort_by' is provided
        if ($request->has('sort_by')) {
            if ($request->sort_by == 'due_date_asc') {
                $query->orderBy('due_date', 'asc');
            } elseif ($request->sort_by == 'due_date_desc') {
                $query->orderBy('due_date', 'desc');
            }
        } else {
            // Default sorting by due date (ascending) if no sort option is provided
            $query->orderBy('due_date', 'asc');
        }

        // Retrieve tasks with applied filters and sorting
        $tasks = $query->get();

        return view('tasks.index', compact('tasks'));
    }




    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => false,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'due_date' => 'required|date',
        ]);

        $task->update($request->only('title', 'description', 'due_date', 'status'));

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}

