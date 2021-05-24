<html>
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<title></title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3"> <!-- mb-3 untuk spasi antara navbar dengan content-->
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Bonku</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Transaksi</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Laporan
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Fitur atau Pentunjuk" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Cari</button>
      </form>
    </div>
  </div>
</nav>

<div class="container-sm">
<form class="form">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Produk</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Nama Produk">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Jumlah">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah Minimum</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Jumlah Minimum">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah Maksimum</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Jumlah Maksimum">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Satuan</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Satuan">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-primary btn-lg btn-block">Input</button>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="reset" class="btn btn-secondary btn-lg btn-block">Batal</button>
    </div>
  </div>
</form>
</div>

<div class="container-sm">
<table class = "table table-bordered" border="0" cellpadding="5" cellspacing="">
  <thead class="thead-light">
    <th>ID</th>
    <th>Nama Produk</th>
    <th>Jumlah</th>
    <th>Jumlah Minimum</th>
    <th>Jumlah Maksimum</th>
    <th>Satuan</th>
    <th>Waktu Dibuat</th>
    <th>Waktu Diubah</th>
  </thead>
  <tbody>
    @foreach($data_produk as $produk)
    <tr>
      <td>{{$produk->id}}</td>
      <td>{{$produk->nama_produk}}</td>
      <td>{{$produk->jumlah}}</td>
      <td>{{$produk->jumlah_minimum}}</td>
      <td>{{$produk->jumlah_maksimum}}</td>
      <td>{{$produk->satuan}}</td>
      <td>{{$produk->created_at}}</td>
      <td>{{$produk->updated_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

</br>
<a href="/standard_user/menu">Kembali</a>

<script>
    function getResolution() {
        alert("Your screen resolution is: " + screen.width + "x" + screen.height);
    }
    </script>
     
<!--button type="button" onclick="getResolution();">Get Resolution</button-->
<div>
<label>Screen Resolution: 
<script>
var resolution = screen.width + " x " + screen.height;
document.write(resolution);
</script>
</label>
</div>

<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>
</html>