@extends('template')

@section('title')
    Edit Data Pegawai
@endsection

@section('head')
    {{-- <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

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

    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        /* Error State */
        input.error {
            border-color: #dc3545 !important;
        }

        /* Valid State */
        input.valid {
            border-color: #28a745 !important;
        }

        /* Error Message Styling */
        .error-message {
            color: #dc3545;
            font-size: 0.875em;
        }
    </style>
@endsection

@section('judulForm', 'Edit Detail Pegawai')

@section('card')
    {{-- Form Edit --}}
    <form action="{{ route('updatepegawai', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Foto --}}
        <div class="mb-3 row">
            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-10">
                @if($pegawai->foto)
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto Pegawai" class="img-fluid"
                            style="max-width: 200px; max-height: 200px;">
                    </div>
                @endif
                <input type="file" id="foto" name="foto" class="form-control">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
            </div>
        </div>

        {{-- Nama --}}
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" id="nama" name="nama" class="form-control" value="{{ $pegawai -> nama }}" required>
                <div class="error-message" id="namaError"></div>
            </div>
        </div>

        {{-- Email --}}
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" id="emailName" name="emailName" class="form-control" placeholder="Masukkan nama email" value="{{ $emailNameNew }}">
                    <span class="input-group-text">@biis.corp</span>
                </div>
                <div class="error-message" id="emailError"></div>
            </div>
        </div>

        {{-- Departemen --}}
        <div class="mb-3 row">
            <label for="departemen" class="col-sm-2 col-form-label">Departemen</label>
            <div class="col-sm-10">
                <select id="departemen" name="departemen" class="form-select" required>
                    <option value="IT" {{ $pegawai->departemen == 'IT' ? 'selected' : '' }}>IT</option>
                    <option value="Finance" {{ $pegawai->departemen == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="HR" {{ $pegawai->departemen == 'HR' ? 'selected' : '' }}>HR</option>
                    <option value="Marketing" {{ $pegawai->departemen == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                </select>
                <div class="error-message" style="color: red" id="departemenError"></div>
            </div>
        </div>

        {{-- Umur --}}
        <div class="mb-3 row">
            <label for="umur" class="col-sm-2 col-form-label">Umur</label>
            <div class="col-sm-10">
                <input type="number" id="umur" name="umur" class="form-control" min="0" value="{{ $pegawai->umur }}" required>
                <div class="error-message" id="umurError"></div>
            </div>
        </div>

        {{-- Jenis Kelamin --}}
        <div class="mb-3 row">
            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                    <option value="Pria" {{ $pegawai->jenis_kelamin == 'Pria' ? 'selected' : '' }}>Pria</option>
                    <option value="Wanita" {{ $pegawai->jenis_kelamin == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                </select>
                <div class="error-message" style="color: red" id="jenisKelaminError"></div>
            </div>
        </div>

        {{-- Tanggal Masuk --}}
        <div class="mb-3 row">
            <label for="tanggal_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-10">
                <input type="text" id="tanggal_masuk" name="tanggal_masuk" class="form-control"
                    value="{{ $pegawai->tanggal_masuk }}" placeholder="Pilih tanggal masuk" required>
            </div>
        </div>

        {{-- CV --}}
        <div class="mb-3 row">
            <label for="cvDropzone" class="col-sm-2 col-form-label">CV</label>
            <div class="col-sm-10">
                @if($pegawai->cv)
                    <a href="{{ asset('storage/' . $pegawai->cv) }}" target="_blank" class="btn btn-primary mb-3">
                        Lihat CV
                    </a>
                @endif
                <input type="file" id="cvDropzone" name="cv" class="form-control">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah CV.</small>
            </div>
        </div>

        {{-- Tombol Simpan --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('detailpegawai', $pegawai->id) }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Validasi jika tidak memiliki nama belakang
            $("#nama").on("blur input", function() {
                if ($(this).val().trim() === "") {
                    $(this).removeClass("valid").addClass("error");
                    $("#namaError").text("Nama harus diisi.");
                } else {
                    $(this).removeClass("error").addClass("valid");
                    $("#namaError").text("");
                }
            });

            // Validasi Email
            $("#emailName").on("blur", function () {
                const emailName = $(this).val().trim();
                const emailFull = emailName + "@biis.corp";
                if (emailName === "") {
                    $(this).addClass("error").removeClass("valid");
                    $("#emailError").text("Email harus diisi.");
                } else {
                    // Kirim request AJAX untuk cek email di database
                    $.ajax({
                        url: "/cek-email",
                        method: "POST",
                        data: {
                            email: emailFull,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.exists && response.id !== {{ $pegawai->id }}) {
                                $("#emailName").addClass("error").removeClass("valid");
                                $("#emailError").text("Email sudah digunakan.");
                            } else {
                                $("#emailName").addClass("valid").removeClass("error");
                                $("#emailError").text("");
                            }
                        },
                        error: function () {
                            $("#emailName").addClass("error").removeClass("valid");
                            $("#emailError").text("Terjadi kesalahan saat memeriksa email.");
                        },
                    });
                }
            });

            // Validasi Umur
            $("#umur").on("blur input", function() {
                if ($(this).val().trim() === "" || $(this).val() < 0) {
                    $(this).removeClass("valid").addClass("error");
                    $("#umurError").text("Umur harus berupa angka lebih dari atau sama dengan 0.");
                } else {
                    $(this).removeClass("error").addClass("valid");
                    $("#umurError").text("");
                }
            });

            // Validasi Dropdown Departemen
            $("#departemen").on("change", function() {
                if ($(this).val() === null) {
                    $(this).removeClass("valid").addClass("error");
                    $("#departemenError").text("Pilih salah satu departemen.");
                } else {
                    $(this).removeClass("error").addClass("valid");
                    $("#departemenError").text("");
                }
            });

            // Validasi Dropdown Jenis Kelamin
            $("#jenis_kelamin").on("change", function() {
                if ($(this).val() === null) {
                    $(this).removeClass("valid").addClass("error");
                    $("#jenisKelaminError").text("Pilih salah satu jenis kelamin.");
                } else {
                    $(this).removeClass("error").addClass("valid");
                    $("#jenisKelaminError").text("");
                }
            });

            // Validasi Tanggal Masuk
            $("#tanggal_masuk").on("blur input", function() {
                if ($(this).val().trim() === "") {
                    $(this).removeClass("valid").addClass("error");
                    $("#tanggalMasukError").text("Pilih tanggal masuk.");
                } else {
                    $(this).removeClass("error").addClass("valid");
                    $("#tanggalMasukError").text("");
                }
            });

            // Select2
            $('#departemen, #jenis_kelamin').select2({
                placeholder: "Pilih",
                allowClear: true
            });

            // Daterangepicker
            $('#tanggal_masuk').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: true,
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
                dropZoneEnabled: true,
                showPreview: false
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
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                success: function(file, response) {
                    console.log("CV berhasil diunggah:", response.cvPath);
                },
                error: function(file, errorMessage) {
                    console.error("Error upload CV:", errorMessage);
                },
            });
        });
    </script>
@endsection
