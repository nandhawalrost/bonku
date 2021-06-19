@include('header.index')

<div class="container-sm">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form" action="/standard_user/menu/produk/store" method="POST">

  {{csrf_field()}}    

  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Nama Produk</label>
    <div class="col-sm-6">
      <input name = "nama_produk" type="text" class="form-control" id="inputEmail3" placeholder="Nama Produk">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Jumlah</label>
    <div class="col-sm-4">
      <input name = "jumlah" type="number" class="form-control" id="inputEmail3" placeholder="Jumlah">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Jumlah Minimum</label>
    <div class="col-sm-4">
      <input name = "jumlah_minimum" type="number" class="form-control" id="inputEmail3" placeholder="Jumlah Minimum">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Jumlah Maksimum</label>
    <div class="col-sm-4">
      <input name = "jumlah_maksimum" type="number" class="form-control" id="inputEmail3" placeholder="Jumlah Maksimum">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Harga</label>
    <div class="col-sm-4">
      <input name = "harga" type="number" class="form-control" id="inputEmail3" placeholder="Harga">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Satuan</label>
    <div class="col-sm-4">
      <input name = "satuan" type="text" class="form-control" id="inputEmail3" placeholder="Satuan">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-primary btn-lg btn-block">Input</button>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="reset" class="btn btn-secondary btn-lg btn-block">Reset</button>
    </div>
  </div>
</form>
</div>

<div class="container-sm">
<div class="box">
  <div class="box-header">
      <div class="form-group row">
        <div class="col-sm-12"> 
        <!-- Button trigger modal -->
          <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Cari Produk</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- search form -->
              <form class="form" action="/standard_user/menu/produk/search_produk" method="GET">
              <div class="modal-body">
                    <div class="">
                      <input name = "nama_produk" type="text" class="form-control" id="inputEmail3" placeholder="Nama Produk">
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Cari</button>
              </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    <div class="box-body table-responsive">
      <table class = "table table-bordered table-hover table-sm" border="0" cellpadding="" cellspacing="">
        <thead class="thead-light">
          <th>ID</th>
          <th>Nama Produk</th>
          <th>Jumlah</th>
          <th>Jumlah Minimum</th>
          <th>Jumlah Maksimum</th>
          <th>Harga</th>
          <th>Satuan</th>
          <th>Waktu Dibuat</th>
          <th>Waktu Diubah</th>
          <th></th>
          <th></th>
        </thead>
        <tbody>
          @foreach($data_produk as $produk)
          <tr>
            <td>{{$produk->id}}</td>
            <td>{{$produk->nama_produk}}</td>
            <td>{{$produk->jumlah}}</td>
            <td>{{$produk->jumlah_minimum}}</td>
            <td>{{$produk->jumlah_maksimum}}</td>
            <td>{{$produk->harga}}</td>
            <td>{{$produk->satuan}}</td>
            <td>{{$produk->created_at}}</td>
            <td>{{$produk->updated_at}}</td>
            <td>
              <a href="/standard_user/menu/produk/{{$produk->id}}/edit">Ubah</a>
            </td>
            <td>
              <a href="/standard_user/menu/produk/{{$produk->id}}/delete_confirmation">Hapus</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $data_produk->links() }}
    </div>
  </div>
</div>
</div>

</br>
<div class="container-sm mb-3">
<a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg btn-block">Kembali</a>
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