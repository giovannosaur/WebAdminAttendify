<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Kirim Data ke Firestore</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: sans-serif; padding: 2rem; }
        form { max-width: 400px; margin: auto; display: flex; flex-direction: column; gap: 1rem; }
        input, button { padding: 0.5rem; font-size: 1rem; }
    </style>
</head>
<body>
    <h2>Form Kirim Data</h2>
    <form action="/kirim" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Masukkan Nama" required>
        <input type="number" name="umur" placeholder="Masukkan Umur" required>
        <button type="submit">Kirim ke Firestore</button>
    </form>
</body>
</html>
