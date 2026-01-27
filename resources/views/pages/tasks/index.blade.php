<!DOCTYPE html>
<html lang="en" class="h-full bg-[#FDFDFC]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papan Kanban - TaskMate</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</head>

<body class="h-full font-sans antialiased bg-gray-50 p-8">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Papan Kanban TaskMate</h2>

        <!-- Add Task Form -->
        <form action="{{ route('tasks.store') }}" method="POST"
            class="mb-8 bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            @csrf
            <div class="flex gap-4 items-end">
                <div class="flex-1">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Tugas</label>
                    <input type="text" name="title" id="title" placeholder="Masukkan judul tugas" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>
                <div class="flex-1">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                        (Opsional)</label>
                    <input type="text" name="description" id="description" placeholder="Tambahkan deskripsi"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>
                <button type="submit"
                    class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all shadow-sm hover:shadow-md">
                    ➕ Tambah
                </button>
            </div>
        </form>

        <!-- Kanban Board -->
        <div class="grid grid-cols-4 gap-6">
            @foreach (['todo' => 'To Do', 'in_progress' => 'In Progress', 'review' => 'Review', 'done' => 'Done'] as $key => $title)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Column Header -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-4 py-3 border-b border-gray-200">
                        <h3 class="text-base font-bold text-gray-800 text-center">{{ $title }}</h3>
                    </div>

                    <!-- Task List -->
                    <div id="{{ $key }}" class="task-list min-h-[400px] p-3 bg-gray-50/50">
                        @foreach ($tasks[$key] as $task)
                            <div class="task bg-white mb-3 p-4 rounded-lg shadow-sm border border-gray-200 cursor-move hover:shadow-md transition-all group"
                                data-id="{{ $task->id }}">
                                <strong
                                    class="block text-sm font-semibold text-gray-800 mb-2">{{ $task->title }}</strong>

                                @if ($task->description)
                                    <small class="block text-xs text-gray-500 mb-3">{{ $task->description }}</small>
                                @endif

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="mt-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full px-3 py-1.5 bg-red-50 text-red-600 text-xs font-medium rounded hover:bg-red-100 transition-all opacity-0 group-hover:opacity-100">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        const statuses = ["todo", "in_progress", "review", "done"];

        statuses.forEach(status => {
            new Sortable(document.getElementById(status), {
                group: "tasks",
                animation: 150,
                ghostClass: 'opacity-50',
                dragClass: 'shadow-2xl',
                onEnd: function(evt) {
                    let taskId = evt.item.getAttribute('data-id');
                    let newStatus = evt.to.id;

                    fetch(`/tasks/${taskId}/status`, {
                        method: "PATCH",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    });
                }
            });
        });
    </script>
</body>

</html>
