<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>


    <title>Document</title>
</head>
<body>
    <table id="pegawaiTable" style="width: 100%; text-align: left;">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Departemen</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPegawai as $pegawai)
            <tr>
                <td>{{ $pegawai->nama }}</td>
                <td>{{ $pegawai->email }}</td>
                <td>{{ $pegawai->departemen }}</td>
                <td>{{ $pegawai->umur }}</td>
                <td>{{ $pegawai->jenis_kelamin }}</td>
                <td>{{ $pegawai->tanggal_masuk }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#pegawaiTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
</body>
</html>
