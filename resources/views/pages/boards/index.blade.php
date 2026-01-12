<h2>Papan Kanban Saya & Publik</h2>

<a href="{{ route('boards.create') }}">
    <button>Buat Papan Baru</button>
</a>

<ul>
    @foreach ($boards as $board)
        <li>
            <a href="{{ route('boards.show', $board->id) }}">
                {{ $board->name }} ({{ $board->visibility }})
            </a>
        </li>
    @endforeach
</ul>
