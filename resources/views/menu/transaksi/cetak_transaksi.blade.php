@include('header.invoice')

<div class="container-sm">
<script>window.print();</script>
<table  class = "table table-borderless table-sm">
    <thead class="">
        <th width="150"></th>
        <th width="1"></th>
        <th></th>
    </thead>
    <tbody>
        <tr>
            <td>ID Transaksi</td>
            <td>:</td>
            <td>{{$data_transaksi->id}}</td>
        </tr>
        <tr>
            <td>Nama Pelanggan</td>
            <td>:</td>
            <td>{{$data_transaksi->nama_pelanggan}}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td>{{$data_transaksi->keterangan}}</td>
        </tr>
        <tr>
            <td>Waktu</td>
            <td>:</td>
            <td>{{$data_transaksi->created_at}}</td>
        </tr>
    </tbody>
</table>
</div>

<div class="container-sm">

<table class = "table table-borderless table-sm" border="0" cellpadding="" cellspacing="">
        <thead class="">
          <th width="50">Nama Produk</th>
          <th width="50">Jumlah</th>
          <th width="50">Harga</th>
          <th width="50">Sub Total</th>
        </thead>
        <tbody>
          @foreach($data_rincian as $rincian)
          <tr>
            <td>{{$rincian->nama_produk}}</td>
            <td>{{$rincian->jumlah." ".$rincian->satuan}}</td>
            <td>Rp. {{$rincian->harga}}</td>
            <td>Rp. {{$rincian->sub_total}}</td>
          </tr>
          @endforeach
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          
          <tr>
            <td></td>
            <td></td>
            <td>Total Harga:</td>
            <td><b>Rp. {{$data_transaksi->total_harga}}</b></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>Total Bayar:</td>
            <td><b>Rp. {{$data_transaksi->total_bayar}}</b></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>Uang Kembali:</td>
            <td><b>Rp. {{$data_transaksi->total_kembali}}</b></td>
          </tr>
        </tbody>
      </table>
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

@include('footer.invoice')