<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Board;

class BoardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $boards = Board::where('user_id', $user->id) // papan milik user
            ->orWhereHas('sharedUsers', function ($q) use ($user) {
                $q->where('user_id', $user->id); // papan yang dishare ke user
            })
            ->get();

        return view('boards.index', compact('boards'));
    }

    public function create()
    {
        return view('boards.create');
    }

    public function store(Request $request)
    {
        Board::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'visibility' => $request->visibility,
        ]);

        return redirect()->route('boards.index');
    }

    public function show(Board $board)
    {
        // cek akses
        if ($board->visibility == 'private' && $board->user_id != Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // kelompokkan task per status
        $tasks = [
            'todo' => $board->tasks()->where('status', 'todo')->get(),
            'in_progress' => $board->tasks()->where('status', 'in_progress')->get(),
            'review' => $board->tasks()->where('status', 'review')->get(),
            'done' => $board->tasks()->where('status', 'done')->get(),
        ];

        return view('boards.show', compact('board', 'tasks'));
    }

    public function share(Request $request, Board $board)
    {
        // pastikan hanya owner yang bisa share
        if ($board->user_id !== Auth::id()) {
            abort(403, 'Kamu bukan pemilik papan ini');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $board->sharedUsers()->syncWithoutDetaching([$request->user_id]);

        return redirect()->back()->with('success', 'Papan berhasil dibagikan!');
    }
}