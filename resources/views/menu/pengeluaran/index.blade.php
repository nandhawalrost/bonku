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

<p  style="font-size:20px;">Input Pengeluaran</p>

<form class="form" action="/standard_user/menu/pengeluaran/store" method="POST">

  {{csrf_field()}}    

  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Deskripsi</label>
    <div class="col-sm-6">
      <input name = "deskripsi" type="text" class="form-control" id="inputEmail3" placeholder="Deskripsi">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Total</label>
    <div class="col-sm-4">
      <input name = "total" type="number" class="form-control" id="inputEmail3" placeholder="Total">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Keterangan</label>
    <div class="col-sm-6">
      <input name = "keterangan" type="text" class="form-control" id="inputEmail3" placeholder="Keterangan">
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
          <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Cari Deskripsi</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Deskripsi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- search form -->
              <form class="form" action="/standard_user/menu/pengeluaran/search_pengeluaran" method="GET">
              <div class="modal-body">
                    <div class="">
                      <input name = "deskripsi" type="text" class="form-control" id="inputEmail3" placeholder="Deskripsi">
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
          <th>Deskripsi</th>
          <th>Total</th>
          <th>Keterangan</th>
          <th>Waktu Dibuat</th>
          <th>Waktu Diubah</th>
          <th></th>
          <th></th>
        </thead>
        <tbody>
          @foreach($data_pengeluaran as $pengeluaran)
          <tr>
            <td>{{$pengeluaran->id}}</td>
            <td>{{$pengeluaran->deskripsi}}</td>
            <td>{{$pengeluaran->total}}</td>
            <td>{{$pengeluaran->keterangan}}</td>
            <td>{{$pengeluaran->created_at}}</td>
            <td>{{$pengeluaran->updated_at}}</td>
            <td>
              <a href="/standard_user/menu/pengeluaran/{{$pengeluaran->id}}/edit">Ubah</a>
            </td>
            <td>
              <a href="/standard_user/menu/pengeluaran/{{$pengeluaran->id}}/delete_confirmation">Hapus</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

</br>
<div class="container-sm mb-3">
<a href="/home" class="btn btn-secondary btn-lg btn-block">Kembali</a>
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