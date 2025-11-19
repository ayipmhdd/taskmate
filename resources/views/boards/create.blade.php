<h2>Buat Papan Baru</h2>

<form action="{{ route('boards.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama papan">
    <select name="visibility">
        <option value="private">Private</option>
        <option value="public">Public</option>
    </select>
    <button type="submit">Simpan</button>
</form>
