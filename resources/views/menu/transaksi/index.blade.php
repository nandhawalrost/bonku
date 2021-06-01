@include('header.index')



@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form" action="/standard_user/menu/transaksi/store_transaksi" method="POST">

  {{csrf_field()}}    


@foreach($data_transaksi as $transaksi)
<div class="container-sm">
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Nama Pelanggan</label>
    <div class="col-sm-6">
      <input name = "nama_pelanggan" value="{{$transaksi->nama_pelanggan}}" type="text" class="form-control" id="" placeholder="Nama Pelanggan">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Keterangan</label>
    <div class="col-sm-6">
      <input name = "keterangan" value="{{$transaksi->keterangan}}" type="text" class="form-control" id="" placeholder="Keterangan">
    </div>
  </div>
</div>
@endforeach

<div class="container-sm">
<div class="box">
  <div class="box-header">
    <div class="box-body table-responsive">
      <table class = "table table-bordered table-hover table-sm" border="0" cellpadding="" cellspacing="">
        <thead class="thead-light">
          <th>Nama Produk</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Sub Total</th>
        </thead>

        <thead class="thead-light">
          <th>
                <input type="text" name="nama_produk"  class="form-control" list="nama_produk" autocomplete="off" />
                    <datalist id="nama_produk">
                    @foreach($nama_produk as $produk)
                        <option value="{{$produk->nama_produk}}"></option>
                    @endforeach
                    </datalist>
                </input>
          </th>
          <th>
                <input name = "jumlah" type="number"  autocomplete="off" class="form-control" id="">
          </th>
          <th>
                
          </th>
          <th>
                
          </th>
        </thead>
        <tbody>
          @foreach($data_rincian as $rincian)
          <tr>
            <td>{{$rincian->nama_produk}}</td>
            <td>{{$rincian->jumlah." ".$rincian->satuan}}</td>
            <td>{{$rincian->harga}}</td>
            <td>{{$rincian->sub_total}}</td>
            <td>
              <a href="/standard_user/menu/transaksi/{{$rincian->id}}/destroy_rincian">Hapus</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<div class="container-sm">

@if(empty($sum_sub_total_terakhir))
<!-- tidak ada sub total -->
@else
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Total</label>
        <div class="col-sm-6">
        <input name = "" id="total_harga" value="{{$sum_sub_total_terakhir}}" oninput="hitungKembali()" type="text" class="form-control" id="" placeholder="Total">
        </div>
    </div>

    @foreach($data_transaksi as $transaksi)
    <div class="form-group row">
        <label for="total_bayar" class="col-sm-2 col-form-label">Total Bayar</label>
        <div class="col-sm-6">
        <input name="total_bayar" id="total_bayar" value="{{$transaksi->total_bayar}}" min="0" oninput="hitungKembali()" type="text" class="form-control" id="" placeholder="Total Bayar">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Uang Kembali</label>
        <div class="col-sm-6">
        <input name="total_kembali" id="total_kembali" value="{{$transaksi->total_kembali}}" oninput="hitungKembali()" type="text" class="form-control" id="" placeholder="Uang Kembali">
        </div>
    </div>
    @endforeach

@endif

    <div class="form-group row">
        <div class="col-sm-12">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Input</button>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
        <button type="button" class="btn btn-dark btn-lg btn-block">Cetak</button>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
        <button type="button" class="btn btn-dark btn-lg btn-block">Buat Transaksi Baru</button>
        </div>
    </div>

</div>

</form>



</br>
<div class="container-sm mb-3">
<a href="/standard_user/menu" class="btn btn-secondary btn-lg btn-block">Kembali</a>
</div>

<script>
function hitungKembali() {
		var total_harga = document.getElementById('total_harga').value;	
		var total_bayar = document.getElementById('total_bayar').value;
		var total_kembali = document.getElementById('total_kembali');	
		var hasil = (+total_bayar - +total_harga);
		total_kembali.value = hasil;
      
		
	}
</script>

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