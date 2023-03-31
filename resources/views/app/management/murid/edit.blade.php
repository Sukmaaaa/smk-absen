@extends('adminlte::page')

@section('title', 'Edit Murid')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container .select2-selection--single {
            display: flex; 
            height: 38px;
            align-items: center;
        }

        .select2-container .select2-results__option {
            display: flex; 
            align-items: center;
        }

    </style>
@stop

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Edit Murid</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>

    <div class="d-flex justify-content-end">
        <span id="time" class="jam"></span>
    </div>
@stop

@section('content')
        <div class="card">
            <div class="card-body">
                <!-- FORM KOMPETENSI -->
                <form action="{{ route('management.murid.update', $murid->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        
                        <!-- FIELD FOTO & NIS -->
                        <div class="row">
                            <x-adminlte-input-file name="foto" label="Foto" placeholder="Pilih foto" :accept="'image/*'" :max-file-size="2000" :validation-style="'outlined'" id="input-foto" fgroup-class="col-md-6" title="Pilih foto">
                            </x-adminlte-input-file>

                            <div class="col-md-6">
                                <label>NIS</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-input type="number" id="nisInput" name="NIS" placeholder="1111222200" title="Isi NIS" maxlength="10" value="{{ old('NIS', $murid->NIS) }}" pattern="[0-9]{10}" maxlength="10" oninput="limitInputLength(this)" required></x-adminlte-input>
                                <p id="nisHint" class="invalid-feedback">NIS harus terdiri dari 10 karakter</p>
                            </div>
                        </div>
                        <!-- END FIELD FOTO & NIS -->

                        <!-- FIELD NAMA & TEMPAT LAHIR -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nama Lengkap</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-input type="text" name="nama" placeholder="Windah" title="Isi nama" required value="{{ old('nama', $murid->nama) }}"></x-adminlte-input>
                            </div>

                            <div class="col-md-6">
                                <label>Tempat Lahir</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-select name="tempat_lahir" class="select2 form-control" title="Pilih tempat lahir" style="height: 38px;" required>
                                    <option value="" disabled selected>Pilih tempat lahir</option>
                                    @foreach($kabupatenKota as $kabupatenKotas)
                                        <option value="{{ $kabupatenKotas->name }}">{{ $kabupatenKotas->name }}</option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
                        </div>
                        <!-- END FIELD NAMA & TEMPAT LAHIR -->

                        <!-- FIELD TANGGAL LAHIR & JENIS KELAMIN -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Tanggal Lahir</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-input type="date" name="tanggal_lahir" class="form-control" title="Isi tanggal lahir" required value="{{ old('tanggal_lahir', $murid->tanggal_lahir) }}">
                                </x-adminlte-input>
                            </div>

                            <div class="col-md-6">
                                <label>Jenis Kelamin</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-select name="jenis_kelamin" title="Pilih jenis kelamin" required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </x-adminlte-select>
                            </div>
                        </div>
                        <!-- END FIELD TANGGAL LAHIR & JENIS KELAMIN -->

                        <!-- FIELD KELAS & JURUSAN -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Kelas</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-select name="kelas" title="Pilih kelas" required>
                                    <option value="" disabled selected>Pilih kelas</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </x-adminlte-select>
                            </div>

                            <div class="col-md-6">
                                <label>Jurusan</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-select name="jurusan" title="Pilih Jurusan" required>
                                    <option value="" disabled selected>Pilih Jurusan</option>
                                    @foreach($jurusan as $jurusans)
                                        <option value="{{ $jurusans->namaJurusan }}"> {{ $jurusans->namaJurusan }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
                        </div>
                        <!-- END FIELD KELAS & JURUSAN -->

                        <!-- FIELD TEMPAT TINGGAL -->
                        <x-adminlte-textarea name="tempat_tinggal" label="Alamat Tempat Tinggal" title="Isi alamat tempat tinggal" placeholder="Jl. Soekarno Hatta No.12" rows=5>
                        {{ old('tempat_tinggal', $murid->tempat_tinggal) }}
                        </x-adminlte-textarea>
                        <!-- END FIELD TEMPAT TINGGAL -->

                        <!-- FIELD RFID -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>RFID</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-input type="text" name="rfid" id="rfid" placeholder="0x82 1x2d 21dp 92x1" maxlength="19" title="Isi rfid" required value="{{ old('rfid', $murid->rfid) }}"></x-adminlte-input>
                                <p id="rfidHint" class="invalid-feedback">Panjang RFID harus 19 karakter</p>
                            </div>
                        </div>
                        <!-- END FIELD RFID -->

                        <!-- TOMBOL SIMPAN & KEMBALI -->
                        <footer class="mt-4">
                            <div class="d-flex flex-row justify-content-between">
                                <a href="{{ route('management.murid.index') }}" class="btn btn-default">Kembali</a>
                                <x-adminlte-button class="btn bg-dark" label="Simpan" type="submit" id="form"></x-adminlte-button>
                            </div>
                        </footer>
                        <!-- END TOMBOL SIMPAN & KEMBALI -->
                    </div>
                </form>
                <!-- END FORM EDIT MURID -->

            </div>
        </div>    
@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        // MENAMPILKAN NAMA FILE YANG SUDAH DIPILIH
        $('#input-foto').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });

        // MENCEGAH PEMILIHAN FOTO LEBIH DARI 1000KB
        document.getElementById('input-foto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const maxSize = 1000 * 1024; // 1000 KB 

            if (file && file.size > maxSize) {
                alert('Ukuran file foto tidak boleh lebih dari 1000 KB');
                event.target.value = '';
            }
        });

        $(document).ready(function() {
            // SEARCH SELECT
            $('.select2').select2();
        });

        // LIMIT INPUT NIS
        function limitInputLength(input) {
            if (input.value.length > input.maxLength) {
                input.value = input.value.slice(0, input.maxLength);
            }
        }

        // FORMAT RFID
        // FORMAT RFID
        const rfidInput = document.getElementById("rfid");
        const rfidHint = document.getElementById("rfidHint");

        rfidInput.addEventListener("input", function(e) {
            let value = e.target.value.replace(/\s/g, ""); // MENGHAPUS SPASI
            value = value.match(/.{1,4}/g).join(" "); // MENAMBAH SPASI SETIAP 4 KARAKTER
            e.target.value = value;
            console.log(value.length);

            if (value.length < 19) {
                rfidHint.style.display = "block";
                rfidInput.classList.add("is-invalid");
            } else {
                rfidHint.style.display = "none";
                rfidInput.classList.remove("is-invalid");
            }
        });

        rfidInput.addEventListener("click", function() {
            if (rfidInput.value.length < 19) {
                rfidHint.style.display = "block";
                rfidInput.classList.add("is-invalid");
            } else {
                rfidHint.style.display = "none";
            }
        });

        rfidInput.addEventListener("blur", function() {
            rfidHint.style.display = "none";
        });

        // NUPTK
        const nisInput = document.getElementById("nisInput");
        const nisHint = document.getElementById("nisHint")
        
        nisInput.addEventListener("input", function() {
            console.log(nisInput.value.length);
            if (nisInput.value.length < 10) {
                nisHint.style.display = "block";
                nisInput.classList.add("is-invalid");
            } else {
                nisHint.style.display = "none";
                nisInput.classList.remove("is-invalid");
            }
        });

        nisInput.addEventListener("click", function() {
            if (nisInput.value.length < 10) {
                nisHint.style.display = "block";
                nisInput.classList.add("is-invalid");
            } else {
                nisHint.style.display = "none";
                nisInput.classList.remove("is-invalid");
            }
        });

        nisInput.addEventListener("blur", function() {
            nisHint.style.display = "none"; 
        });

        // SWEET ALERT
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        })

        @if(Session::has('error'))
            Toast.fire({
                icon: 'error',
                title: '{{ Session::get('error') }}'
            })
        @endif
    </script>
@stop