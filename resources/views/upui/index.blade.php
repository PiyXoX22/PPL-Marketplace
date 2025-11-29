<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Banner (Contoh Statis)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Manajemen Banner — Contoh Statis</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">Banner Aktif</div>
        <div class="card-body text-center">
            <img src="https://via.placeholder.com/900x250?text=Banner+Aktif" class="img-fluid mb-3" style="border-radius: 10px;">
            <button class="btn btn-warning btn-sm">Ganti Banner</button>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">Daftar Banner Lain</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Preview</th>
                        <th>Nama Banner</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="https://via.placeholder.com/250x80?text=Banner+1" width="200"></td>
                        <td>Banner Promo Akhir Tahun</td>
                        <td>
                            <button class="btn btn-primary btn-sm">Aktifkan</button>
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="https://via.placeholder.com/250x80?text=Banner+2" width="200"></td>
                        <td>Banner Diskon 50%</td>
                        <td>
                            <button class="btn btn-primary btn-sm">Aktifkan</button>
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>