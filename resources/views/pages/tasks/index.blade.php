<!DOCTYPE html>
<html>
<head>
    <title>Papan Kanban - TaskMate</title>
    <style>
        .kanban { display: flex; gap: 20px; }
        .column { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 8px; }
        .task { background: #f5f5f5; margin: 5px 0; padding: 8px; border-radius: 5px; }
        h3 { text-align: center; }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</head>
<body>
    <h2>Papan Kanban TaskMate</h2>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Judul tugas">
        <input type="text" name="description" placeholder="Deskripsi (opsional)">
        <button type="submit">Tambah</button>
    </form>

    <div class="kanban">
        @foreach (['todo' => 'To Do', 'in_progress' => 'In Progress', 'review' => 'Review', 'done' => 'Done'] as $key => $title)
        <div class="column">
            <h3>{{ $title }}</h3>
            <div id="{{ $key }}" class="task-list" style="min-height: 200px; padding:5px; background:#fafafa;">
                @foreach ($tasks[$key] as $task)
                    <div class="task" data-id="{{ $task->id }}">
                        <strong>{{ $task->title }}</strong><br>
                        <small>{{ $task->description }}</small><br>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="margin-top:5px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <script>
        const statuses = ["todo", "in_progress", "review", "done"];

        statuses.forEach(status => {
            new Sortable(document.getElementById(status), {
                group: "tasks",
                animation: 150,
                onEnd: function (evt) {
                    let taskId = evt.item.getAttribute('data-id');
                    let newStatus = evt.to.id;

                    fetch(`/tasks/${taskId}/status`, {
                        method: "PATCH",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({ status: newStatus })
                    });
                }
            });
        });
    </script>
</body>
</html>
