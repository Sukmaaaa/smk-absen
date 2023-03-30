@extends('adminlte::page')

@section('title', 'Tambah Murid')

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
        <h1>Tambah Murid</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>

    <div class="d-flex justify-content-end">
        <span id="time" class="jam"></span>
    </div>
@stop

@section('content')
        <div class="card">
            <div class="card-body">
                <!-- FORM TAMBAH MURID -->
                <form action="{{ route('management.murid.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        
                        <!-- FIELD FOTO & NIS -->
                        <div class="row">
                            <x-adminlte-input-file name="foto" label="Foto" placeholder="Pilih foto" :accept="'image/*'" :max-file-size="2000" :validation-style="'outlined'" id="input-foto" fgroup-class="col-md-6" title="Pilih foto">
                            </x-adminlte-input-file>

                            <div class="col-md-6">
                                <label>NUPTK</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-input type="number" name="NIS" placeholder="1111222200" title="Isi NIS" maxlength="10" required></x-adminlte-input>
                            </div>
                        </div>
                        <!-- END FIELD FOTO & NIS -->

                        <!-- FIELD NAMA & TEMPAT LAHIR -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nama Lengkap</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-input type="text" name="nama" placeholder="Windah" title="Isi nama" required></x-adminlte-input>
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
                                <x-adminlte-input type="date" name="tanggal_lahir" class="form-control" title="Isi tanggal lahir" required>
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
                        </x-adminlte-textarea>
                        <!-- END FIELD TEMPAT TINGGAL -->

                        <!-- FIELD RFID -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>RFID</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-input type="text" name="rfid" id="rfid" placeholder="0x82 1x2d 21dp 92x1" maxlength="19" title="Isi rfid" required></x-adminlte-input>
                            </div>
                        </div>
                        <!-- END FIELD RFID -->

                        <!-- TOMBOL SIMPAN & KEMBALI -->
                        <footer class="mt-4">
                            <div class="d-flex flex-row justify-content-between">
                                <a href="{{ route('management.guru.index') }}" class="btn btn-default">Kembali</a>
                                <x-adminlte-button class="btn bg-dark" label="Simpan" type="submit" id="form"></x-adminlte-button>
                            </div>
                        </footer>
                        <!-- END TOMBOL SIMPAN & KEMBALI -->
                    </div>
                </form>
                <!-- END FORM TAMBAH GURU -->

            </div>
        </div>    
@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
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

        // FORMAT RFID
        const rfidInput = document.getElementById("rfid");

        rfidInput.addEventListener("input", function(e) {
            let value = e.target.value.replace(/\s/g, ""); // MENGHAPUS SPASI
            value = value.match(/.{1,4}/g).join(" "); // MENAMBAH SPASI SETIAP 4 KARAKTER
            e.target.value = value;
            console.log(value.length);
        });
    </script>
@stop