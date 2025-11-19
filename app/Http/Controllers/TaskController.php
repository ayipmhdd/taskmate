<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = [
            'todo'       => Task::where('user_id', Auth::id())->where('status', 'todo')->get(),
            'in_progress'=> Task::where('user_id', Auth::id())->where('status', 'in_progress')->get(),
            'review'     => Task::where('user_id', Auth::id())->where('status', 'review')->get(),
            'done'       => Task::where('user_id', Auth::id())->where('status', 'done')->get(),
        ];

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'description' => $request->description,
            'status'  => 'todo',
        ]);

        return back();
    }

    public function updateStatus(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:todo,in_progress,review,done',
        ]);

        $task->update(['status' => $request->status]);

        return back();
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return back();
    }
}
