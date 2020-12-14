<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Buku Tamu Museum Rempah</title>
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">
            Museum Rempah
        </a>
    </div>
</nav>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h3 class="card-title">Buku Tamu</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{url('guest-book/'.$museum_name)}}">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap<span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Instansi</label>
                    <input type="text" name="institution" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-dark float-right">SIMPAN</button>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <p class="text-right">Jumlah pengunjung Museum Rempah : {{number_format(\App\Model\guest_book::count_visitor($museum_name))}}</p>
        </div>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
