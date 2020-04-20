<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laporan Pelunasan</title>
</head>
<style>
	
.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
  background-color: transparent;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(0, 0, 0, 0.05);
}

</style>
<body>
	<h1>Laporan Pelunasan Lengkap</h1>
	<br>
	<br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>KTP</th>
				<th>Nama</th>
				<th>Region</th>
				<th>Jumlah</th>
				<th>Nama Bank</th>
				<th>Nomor Rekening</th>
				<th>Pemilik</th>
				<th>Tanggal</th>
			</tr>
		</thead>
		<tbody>
			@foreach($pembayarans as $pembayaran)
			<tr>
				<td>{{$pembayaran->kolektor->nomor_ktp}}</td>
				<td>{{$pembayaran->kolektor->nama}}</td>
				<td>{{$pembayaran->kolektor->region}}</td>
				<td>Rp. {{$pembayaran->jumlah_pembayaran}}</td>
				<td>{{$pembayaran->nama_bank}}</td>
				<td>{{$pembayaran->nomor_rekening}}</td>
				<td>{{$pembayaran->nama_pemilik}}</td>
				<td>{{$pembayaran->created_at}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</body>
</html>