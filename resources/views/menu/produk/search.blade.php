@include('header.index')

<div class="container-sm">
<div class="box">
  <div class="box-header">
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
          @foreach($search_produk as $produk)
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
      {{ $search_produk->links() }}
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