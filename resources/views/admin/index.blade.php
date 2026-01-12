<h1>Dashboard Admin</h1>
<p>Halo Admin {{ Auth::user()->name }}!</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

<a href="{{ route('tasks.index') }}">
    <button style="padding:10px 20px; margin:10px 0;">Kelola Tugas (Kanban)</button>
</a>