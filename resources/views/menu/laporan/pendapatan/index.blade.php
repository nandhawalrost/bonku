@include('header.index')

<div class="container-sm">
<div class="box">
  <div class="box-header">
    <div class="box-body table-responsive">
      <h3>Pendapatan Kotor Hari Ini: </h3>
      </br>
      <p>Total pendapatan kotor anda hari ini dari input transaksi dan input pendapatan adalah Rp{{$sum_transaksi_hari_ini+$sum_pendapatan_hari_ini}},  dengan frekuensi transaksi = {{$frekuensi_transaksi_hari_ini}} dan input pendapatan = {{$frekuensi_pendapatan_hari_ini}} </p>
      <p  style="font-size:20px;">Dari Input Transaksi:</p>
      <table class = "table table-bordered table-hover table-sm" border="0" cellpadding="" cellspacing="">
        <thead class="thead-light">
          <th>ID</th>
          <th>Nama Pelanggan</th>
          <th>Total</th>
          <th>Keterangan</th>
          <th>Waktu Dibuat</th>
          <th>Waktu Diubah</th>
        </thead>
        <tbody>
          @foreach($data_transaksi_hari_ini as $transaksi)
          <tr>
            <td>{{$transaksi->id}}</td>
            <td>{{$transaksi->nama_pelanggan}}</td>
            <td>{{$transaksi->total_harga}}</td>
            <td>{{$transaksi->keterangan}}</td>
            <td>{{$transaksi->created_at}}</td>
            <td>{{$transaksi->updated_at}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $data_transaksi_hari_ini->links() }}
    </div>
    <label><b>Total Pendapatan: {{$sum_transaksi_hari_ini}}</b></label>
    </br><label><b>Frekuensi: {{$frekuensi_transaksi_hari_ini}}</b></label>
    </br><label><b>Terendah: {{$min_transaksi_hari_ini}}</b></label>
    </br><label><b>Tertinggi: {{$max_transaksi_hari_ini}}</b></label>
    </br><label><b>Rata-rata: {{$rata_transaksi_hari_ini}}</b></label>
    </br>
    </br>
    <div class="box-body table-responsive">
      <p  style="font-size:20px;">Dari Input Pendapatan:</p>
      <table class = "table table-bordered table-hover table-sm" border="0" cellpadding="" cellspacing="">
        <thead class="thead-light">
          <th>ID</th>
          <th>Nama Pelanggan</th>
          <th>Total</th>
          <th>Keterangan</th>
          <th>Waktu Dibuat</th>
          <th>Waktu Diubah</th>
        </thead>
        <tbody>
          @foreach($data_pendapatan_hari_ini as $pendapatan)
          <tr>
            <td>{{$pendapatan->id}}</td>
            <td>{{$pendapatan->deskripsi}}</td>
            <td>{{$pendapatan->total}}</td>
            <td>{{$pendapatan->keterangan}}</td>
            <td>{{$pendapatan->created_at}}</td>
            <td>{{$pendapatan->updated_at}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $data_pendapatan_hari_ini->links() }}
    </div>
    <label><b>Total Pendapatan: {{$sum_pendapatan_hari_ini}}</b></label>
    </br><label><b>Frekuensi: {{$frekuensi_pendapatan_hari_ini}}</b></label>
    </br><label><b>Terendah: {{$min_pendapatan_hari_ini}}</b></label>
    </br><label><b>Tertinggi: {{$max_pendapatan_hari_ini}}</b></label>
    </br><label><b>Rata-rata: {{$rata_pendapatan_hari_ini}}</b></label>
  </div>
</div>

<div class="form-group row">
        <div class="col-sm-12"> 
        <!-- Button trigger modal -->
          <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#cariTanggal">Cari Tanggal</button>
          <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Cari Bulan</button>
          <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Cari Tahun</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="cariTanggal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Berdasar Tanggal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- search form -->
              <form class="form" action="/standard_user/menu/laporan/pendapatan/pendapatan_harian/search_tanggal" method="GET">
              <div class="modal-body">
                    <div class="">
                    <input name="tanggal" type="date" id="tanggal" name="tanggal">
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

</div>

</br>

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