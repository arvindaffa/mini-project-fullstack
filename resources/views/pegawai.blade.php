@extends('template')

@section('title')
    Data Pegawai
@endsection

@section('head')
    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        .btn-primary {
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('judulForm')
    Daftar Pegawai
@endsection

@section('card')
    <a href="/tambahpegawai" class="btn btn-primary">
        <i class="fas fa-user-plus"></i> Tambah Pegawai
    </a>
    <table id="pegawaiTable" class="table table-bordered display nowrap" style="width:100%">
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
            {{-- Data akan diisi melalui AJAX --}}
        </tbody>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // DataTables dengan Ajax
            var table = $('#pegawaiTable').DataTable({
                ajax: {
                    url: "http://127.0.0.1:8000/api/pegawai",
                    dataSrc: 'data',
                },
                columns: [
                    { data: 'nama' },
                    { data: 'email' },
                    { data: 'departemen' },
                    { data: 'umur' },
                    { data: 'jenis_kelamin' },
                    { data: 'tanggal_masuk' }
                ],
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                scrollX: true
            });

            // Ambil data dari baris yang diklik
            $('#pegawaiTable tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
                if (data) {
                    window.location.href = "/detailpegawai/" + data.id;
                }
            });
        });
    </script>
@endsection
