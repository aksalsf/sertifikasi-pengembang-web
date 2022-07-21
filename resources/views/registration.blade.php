<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Pendaftaran</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center p-5" style="min-height: 100vh">
        <form class="card p-5" style="width: 45%" method="POST" action="/register">
            @csrf
            <h1 class="text-center">Pendaftaran</h1>
            <div class="d-flex flex-column gap-3 mb-3">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="d-flex flex-column gap-3 mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="d-flex flex-column gap-3 mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-flex flex-column gap-3 mb-3">
                <label for="birthinfo">TTL</label>
                <input type="text" name="birthinfo" class="form-control" required>
            </div>
            <div class="d-flex flex-column gap-3 mb-3">
                <label for="address">Alamat</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="d-flex flex-column gap-3 mb-3">
                <label for="phone">Nomor Telepon</label>
                <input type="tel" name="phone" class="form-control" required>
            </div>
            <div class="d-flex flex-column gap-3 mb-3">
                <label for="math">Nilai Matematika</label>
                <input type="number" max="100" name="math" class="form-control" required>
            </div>
            <div class="d-flex flex-column gap-3 mb-3">
                <label for="indonesian">Nilai Bahasa Indonesia</label>
                <input type="number" max="100" name="indonesian" class="form-control" required>
            </div>
            <div class="d-flex flex-column gap-3 mb-3">
                <label for="english">Nilai Bahasa Inggris</label>
                <input type="number" max="100" name="english" class="form-control" required>
            </div>
            <div class="d-flex flex-column gap-3 mb-3">
                <label for="photo">Foto</label>
                <input type="file" max="100" name="photo" class="form-control" accept="image/png, image/gif, image/jpeg" required>
            </div>
            <button class="btn btn-primary" type="submit">
                Daftar
            </button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
