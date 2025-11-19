<h1>Dashboard User</h1>
<p>Selamat datang, {{ Auth::user()->name }}!</p>

<!-- Tombol menuju papan Kanban -->
<a href="{{ route('tasks.index') }}">
    <button style="padding:10px 20px; margin:10px 0;">Lihat Papan Kanban</button>
</a>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

<a href="{{ route('boards.index') }}">
    <button style="padding:10px 20px;">Lihat Papan Kanban</button>
</a>