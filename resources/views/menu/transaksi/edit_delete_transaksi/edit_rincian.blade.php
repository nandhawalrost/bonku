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

</div>

<div class="container-sm">
ID: <b>{{$id_transaksi}}</b></br></br>
<p>*<b>Setelah menghapus rincian</b> Total Harga, Total Kembali, Total Bayar tidak terubah otomatis, hal ini kami lakukan demi menghindari data yang tidak akurat. <a href = "/standard_user/menu/transaksi/edit_delete_transaksi">Klik disini</a> untuk melakukan perubahan</p>
<div class="box">
  <div class="box-header">
    <div class="box-body table-responsive">
    <table class = "table table-bordered table-hover table-sm" border="0" cellpadding="" cellspacing="">
        <thead class="thead-light">
          <th>Nama Produk</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Sub Total</th>
          <th></th>
        </thead>
        <tbody>
          @foreach($data_rincian as $rincian)
          <tr>
            <td>{{$rincian->nama_produk}}</td>
            <td>{{$rincian->jumlah." ".$rincian->satuan}}</td>
            <td>{{$rincian->harga}}</td>
            <td>{{$rincian->sub_total}}</td>
            <td>
              <a href="/standard_user/menu/transaksi/edit_delete_transaksi/edit_rincian/{{$rincian->id}}/destroy_rincian">Hapus</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $data_rincian->links() }}
    </div>
  </div>
</div>
</div>

</br>
<div class="container-sm mb-3">
<a href="/standard_user/menu/transaksi/edit_delete_transaksi" class="btn btn-secondary btn-lg btn-block">Kembali</a>
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