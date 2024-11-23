<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Daterangepicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- FileInput -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput/js/fileinput.min.js"></script>

    <!-- Dropzone -->
    <link href="https://cdn.jsdelivr.net/npm/dropzone/dist/dropzone.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/dropzone/dist/dropzone-min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h3>Form Tambah Pegawai</h3>
            </div>
            <div class="card-body">
                <form action="/tambahpegawai/add" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Depan -->
                    <div class="mb-3">
                        <label for="firstName" class="form-label">Nama Depan:</label>
                        <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Masukkan nama depan" required>
                    </div>

                    <!-- Nama Belakang -->
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Nama Belakang:</label>
                        <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Masukkan nama belakang" required>
                    </div>

                    <!-- Umur -->
                    <div class="mb-3">
                        <label for="umur" class="form-label">Umur:</label>
                        <input type="number" id="umur" name="umur" class="form-control" placeholder="Masukkan umur" required>
                    </div>

                    <!-- Departemen -->
                    <div class="mb-3">
                        <label for="departemen" class="form-label">Departemen:</label>
                        <select id="departemen" name="departemen" class="form-select">
                            <option value="" disabled selected>Pilih Departemen</option>
                            <option value="IT">IT</option>
                            <option value="Finance">Finance</option>
                            <option value="HR">HR</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk:</label>
                        <input type="text" id="tanggal_masuk" name="tanggal_masuk" class="form-control" placeholder="Pilih tanggal masuk" required>
                    </div>

                    <!-- Foto -->
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto:</label>
                        <input id="foto" name="foto" type="file" class="form-control">
                    </div>

                    <!-- CV -->
                    <div class="mb-3">
                        <label for="cvDropzone" class="form-label">CV:</label>
                        <div id="cvDropzone" class="dropzone"></div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-block">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Select2
            $('#departemen, #jenis_kelamin').select2({
                placeholder: "Pilih",
                allowClear: true
            });

            // Daterangepicker
            $('#tanggal_masuk').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2014,
                maxDate: moment().format('YYYY-MM-DD'),
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            // FileInput
            $('#foto').fileinput({
                theme: 'fa',
                allowedFileExtensions: ['jpg', 'jpeg', 'png'],
                showUpload: false,
                maxFileSize: 2048,
                showCaption: true,
                browseOnZoneClick: true,
                dropZoneEnabled: true
            });

            Dropzone.autoDiscover = false;
            const cvDropzone = new Dropzone("#cvDropzone", {
                url: "{{ route('uploadCv') }}",
                maxFiles: 1,
                acceptedFiles: ".pdf",
                dictDefaultMessage: "Seret dan jatuhkan CV di sini atau klik untuk mengunggah",
                addRemoveLinks: true,
                maxFilesize: 5,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (file, response) {
                    console.log("CV berhasil diunggah:", response.cvPath);
                },
                error: function (file, errorMessage) {
                    console.error("Error upload CV:", errorMessage);
                }
            });
        });
    </script>
</body>
</html>
