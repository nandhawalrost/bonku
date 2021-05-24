<html>
<head><title></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<body>

<table border="1">
  <tr bgcolor = "#fffaad">
    <th>ID</th>
    <th>Nama Produk</th>
    <th>Jumlah</th>
    <th>Jumlah Minimum</th>
    <th>Jumlah Maksimum</th>
    <th>Satuan</th>
    <th>Waktu Dibuat</th>
    <th>Waktu Diubah</th>
  </tr>
  @foreach($data_produk as $produk)
  <tr bgcolor = "white">
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
</table>

</br>
<a href="/standard_user/menu">Kembali</a>
</body>
</html>