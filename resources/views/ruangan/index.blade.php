<!DOCTYPE html>
<html>
<head>
    <title>Data Ruangan</title>
</head>
<body>
    <h1>Tambah Ruangan</h1>
    <form method="POST" action="/ruangan">
        @csrf
        <input type="text" name="nama" placeholder="Nama"><br>
        <input type="text" name="kapasitas" placeholder="Kapasitas"><br>
        <button type="submit">Simpan</button>
    </form>

    <h2>List Ruangan</h2>
    <ul>
        @foreach($data as $ruangan)
            <li>{{ $ruangan->nama }} - {{ $ruangan->kapasitas }}</li>
        @endforeach
    </ul>
</body>
</html>