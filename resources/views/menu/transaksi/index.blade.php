<html>
<head><title></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<body>
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
        
    </div>
@endif

{{ __('You are logged in!') }}
{{--($id_transaksi_terakhir)--}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<nav class="navbar sticky-top navbar-dark bg-dark justify-content-between">
<a class="navbar-brand">Apps Tokotokotok</a>
<form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>

<div class = "container">

<h3 class = "p-3">Transaksi</h3>
<form class="w-75 p-3" action="/produk/create" method="POST">

{{csrf_field()}}

    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">ID Pelanggan</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="id_pelanggan" placeholder="ID Pelanggan">
        </div>
    </div>

</form>

<!--table class="table table-hover col-10">
    <tr>
        <th>ID</th>
        <th>ID PELANGGAN</th>
        <th>TOTAL HARGA</th>
        <th>DIBAYAR</th>
        <th>KEMBALIAN</th>
        <th>AKSI</th>
    </tr>

    @foreach($data_transaksi as $transaksi)
    <tr>
        <td>{{$transaksi->id}}</td>
        <td>{{$transaksi->id_pelanggan}}</td>
        <td>{{$transaksi->total_harga}}</td>
        <td>{{$transaksi->dibayar}}</td>
        <td>{{$transaksi->kembalian}}</td>
        <td>
        <a href="" class="btn btn-warning btn-sm">Edit</a>
        <a href="" class="btn btn-danger btn-sm">Delete</a>
        </td>
    </tr>
    @endforeach
</table -->


<form class="w-75 p-3" action="/transaksi/create" method="POST">

{{csrf_field()}}

    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label" >ID Transaksi</label>
        <div class="col-sm-10">
            
        <input type="text" class="form-control-plaintext" name="id_transaksi" placeholder="ID Transaksi" value="{{($id_transaksi_terakhir)}}" readonly>    
            

            
        </div>
    </div>

    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Produk</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Qty</label>
        <div class="col-sm-10">
        <input type="number" class="form-control" name="qty" placeholder="Qty">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Harga</label>
        <div class="col-sm-10">
        <input type="number" class="form-control" name="harga" placeholder="Harga">
        </div>
    </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-dark ">Tambah</button>
    </div>
  </div>
</form>

<table class="table table-hover col-8">
    <tr>
        <th>ID Rincian</th>
        <th>ID Transaksi</th>
        <th>Nama Produk</th>
        <th>Qty</th>
        <th>Harga</th>
        <th></th>
    </tr>

    @foreach($data_rinciantransaksi as $rtransaksi)
    <tr>
        <td>{{$rtransaksi->id}}</td>
        <td>{{$rtransaksi->id_transaksi}}</td>
        <td>{{$rtransaksi->nama_produk}}</td>
        <td>{{$rtransaksi->qty}}</td>
        <td>{{$rtransaksi->harga}}</td>
        <td>
        <a href="" class="btn btn-secondary btn-sm">Delete</a>
        </td>
    </tr>
    @endforeach
</table>

<form class="w-75 p-3" action="/transaksi/bayar" method="POST">

{{csrf_field()}}

    <input type="text" class="form-control-plaintext" name="id_transaksi" placeholder="ID Transaksi" value="{{($id_transaksi_terakhir)}}" readonly>    

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Total Harga</label>
        <div class="col-sm-10">
        <input id="total_harga" type="number" class="form-control" name="total_harga" placeholder="Total Harga" value="{{$sum_harga}}" onchange ='calculate()' >
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Dibayar</label>
        <div class="col-sm-10">
        <input id = "dibayar" type="number" class="form-control" name="dibayar" placeholder="Dibayar" onchange ='calculate()' >
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Kembalian</label>
        <div class="col-sm-10">
        <input id = "kembalian" type="number" class="form-control" name="kembalian" placeholder="Kembalian" onchange ='calculate()' >
        </div>
    </div>
  
 
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-dark btn-lg btn-block">Bayar</button>
      <button type="submit" class="btn btn-secondary btn-lg btn-block">Batal</button>
    </div>
  </div>
</form>
</div>
</body>

<script>

function calculate() {
		var total_harga = document.getElementById('total_harga').value;	
		var dibayar = document.getElementById('dibayar').value;
		var kembalian = document.getElementById('kembalian');	
		var hasil = (+dibayar - +total_harga);
		kembalian.value = hasil;
      
		
	}
</script>

</html>