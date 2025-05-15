<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selamat Datang</title>
</head>
<body>
    <h1>Hello World</h1>
    <p>Selamat Datang di toko BookSales</p>

    @foreach ($books as $book)
        <ul>
            <li>ID: {{ $book['id'] }}</li>
            <li>Nama Buku: {{ $book['title'] }}</li>
            <li>Deskripsi: {{ $book['description'] }}</li>
            <li>Harga: {{ $book['price'] }}</li>
            <li>Stock: {{ $book['stock'] }}</li>
        </ul>
    @endforeach
</body>
</html>