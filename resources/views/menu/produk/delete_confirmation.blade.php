@include('header.index')

<div class="container-sm mb-3">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form" action="/standard_user/menu/produk/{{$produk->id}}/destroy" method="GET">

  {{csrf_field()}}    

  <div class="form-group row float">
    <label for="" class="col-sm-2 col-form-label">Nama Produk</label>
    <label for="" class="col-sm-2 col-form-label">:</label>
    <div class="col-sm-6">
      {{$produk->nama_produk}}
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Jumlah</label>
    <label for="" class="col-sm-2 col-form-label">:</label>
    <div class="col-sm-4">
      {{$produk->jumlah}}
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Jumlah Minimum</label>
    <label for="" class="col-sm-2 col-form-label">:</label>
    <div class="col-sm-4">
      {{$produk->jumlah_minimum}}
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Jumlah Maksimum</label>
    <label for="" class="col-sm-2 col-form-label">:</label>
    <div class="col-sm-4">
      {{$produk->jumlah_maksimum}}
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Harga</label>
    <label for="" class="col-sm-2 col-form-label">:</label>
    <div class="col-sm-4">
      {{$produk->harga}}
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Satuan</label>
    <label for="" class="col-sm-2 col-form-label">:</label>
    <div class="col-sm-4">
      {{$produk->satuan}}
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-primary btn-lg btn-block">Konfirmasi Hapus</button>
    </div>
  </div>
</form>
</div>

<div class="container-sm mb-3">
<a href="/standard_user/menu/produk" class="btn btn-secondary btn-lg btn-block">Kembali</a>
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

@include('footer.index')