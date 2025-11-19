<h2>{{ $board->name }} ({{ $board->visibility }})</h2>

@include('tasks.index', ['tasks' => $tasks, 'board' => $board])


@if(auth()->id() === $board->user_id)
    <div class="mb-4">
        <h3>Share Board</h3>

        @if(session('success'))
            <div style="color: green; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('boards.share', $board->id) }}" method="POST">
            @csrf
            <label for="user_id">Pilih User:</label>
            <select name="user_id" id="user_id">
                @foreach(\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <button type="submit">Share</button>
        </form>
    </div>
@endif
