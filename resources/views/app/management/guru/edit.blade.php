@extends('adminlte::page')

@section('title', 'Edit Guru')

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
        <h1>Edit Guru</h1>
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
                <form action="{{ route('management.guru.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        
                        <!-- FIELD FOTO & NUPTK -->
                        <div class="row">
                            <x-adminlte-input-file name="foto" label="Foto" placeholder="Pilih foto" :accept="'image/*'" :max-file-size="1000" :validation-style="'outlined'" id="input-foto" fgroup-class="col-md-6" title="Pilih foto">
                            </x-adminlte-input-file>

                            <div class="col-md-6">
                                <label>NUPTK</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-input type="number" id="nuptkInput" name="NUPTK" placeholder="1111 2222 3333 1" pattern="[0-9]{16}" maxlength="16" title="Isi NUPTK (16 digit)" oninput="limitInputLength(this)" required></x-adminlte-input>
                                <p id="nuptkHint" class="invalid-feedback">NUPTK harus terdiri dari 16 karakter</p>
                            </div>
                        </div>
                        <!-- END FIELD FOTO & NUPTK -->

                        <!-- FIELD NAME & USERNAME -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nama</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-input type="text" name="name" placeholder="Windah" title="Isi nama" required value="{{ old('name', $user->name) }}"></x-adminlte-input>
                            </div>
                            <div class="col-md-6">
                                <label>Username</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-input type="text" name="username" placeholder="brando_windah" title="Isi username" required value="{{ old('username', $user->username) }}"></x-adminlte-input>
                            </div>
                        </div>
                        <!-- END FIELD NAME & USERNAME -->

                        <!-- FIELD TEMPAT LAHIR & TANGGAL LAHIR -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Tempat Lahir</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-select name="tempat_lahir" class="select2 form-control" title="Pilih tempat lahir" style="height: 38px;" required>
                                    <option value="" disabled selected>Pilih tempat lahir</option>
                                    @foreach($kabupatenKota as $kabupatenKotas)
                                        <option value="{{ $kabupatenKotas->name }}" {{ old('tempat_lahir') == $kabupatenKotas->name ? 'selected' : '' }}>{{ $kabupatenKotas->name }}</option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
                            <div class="col-md-6">
                                <label>Tanggal Lahir</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-input type="date" name="tanggal_lahir" class="form-control" title="Isi tanggal lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" required>
                                </x-adminlte-input>
                            </div>
                        </div>
                        <!-- END FIELD TEMPAT LAHIR & TANGGAL LAHIR -->

                        <!-- FIELD JENIS KELAMIN DAN KOMPETENSI -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Jenis Kelamin</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-select name="jenis_kelamin" title="Pilih jenis kelamin" value="{{ old('jenis_kelamin') }}" required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </x-adminlte-select>
                            </div>
                            <div class="col-md-6">
                                <label>Kompetensi</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-select name="kompetensi" title="Pilih kompetensi" required>
                                    <option value="" disabled selected>Pilih Kompetensi</option>
                                    @foreach($kompetensi as $kompetensis)
                                        <option value="{{ $kompetensis->id }}"> {{ $kompetensis->namaKompetensi }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
                        </div>
                        <!-- END FIELD JENIS KELAMIN DAN KOMPETENSI -->

                        <!-- FIELD ROLE & RFID -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Role</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-select name="role" title="Pilih role" required>
                                    <option value="" disabled selected>Pilih Role</option>
                                    @foreach($role as $optionRole)
                                        <option value ="{{ $optionRole->name }}"> {{ $optionRole->name }}
                                    @endforeach
                                </x-adminlte-select>
                            </div>

                            <div class="col-md-6">
                                <label>RFID</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                                <x-adminlte-input type="text" name="rfid" id="rfid" placeholder="0x82 1x2d 21dp 92x1" maxlength="19" title="Isi rfid" required></x-adminlte-input>
                                <p id="rfidHint" class="invalid-feedback">Panjang RFID harus terdiri dari 19 karakter</p>
                            </div>
                        </div>
                        <!-- END FIELD PASSWORD & RFID -->

                        <!-- FIELD PASSWORD DISEMBUNYIKAN -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Ganti Password</label>
                                <input class="form-control" id="password" type="password" name="password" placeholder="***************" title="Isi password baru">
                                <p id="passwordHint" class="invalid-feedback">Password harus terdiri dari 8 karakter dengan angka, huruf besar dan kecil.</p>
                            </div>

                            <div class="col-md-6">
                                <label id="ulangiPasswordLabel">Ulangi Password</label>
                                <input class="form-control" id="ulangiPassword" type="password" name="password_baru" placeholder="***************">
                                <div id="ulangiPasswordFeedback" class="invalid-feedback">Password tidak sesuai</div>
                            </div>
                        </div>
                        <!-- END FIELD ROLE -->

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
                <!-- END FORM KEHADIRAN -->

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

        // LIMIT INPUT NUPTK
        function limitInputLength(input) {
            if (input.value.length > input.maxLength) {
                input.value = input.value.slice(0, input.maxLength);
            }
        }

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

        // PASSWORD
        const passwordInput = document.getElementById("password");
        const passwordHint = document.getElementById("passwordHint");
        const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

        passwordInput.addEventListener("input", function() {
        const passwordValue = passwordInput.value;

        if (!regex.test(passwordValue)) {
            passwordHint.style.display = "block";
            passwordInput.classList.add("is-invalid");
        } else {
            passwordHint.style.display = "none";
            passwordInput.classList.remove("is-invalid");
        }
        });

        passwordInput.addEventListener("click", function() {
            const passwordValue = passwordInput.value; 
            if (!regex.test(passwordValue)) {
                passwordHint.style.display = "block";
                passwordInput.classList.add("is-invalid");
            } else {
                passwordHint.style.display = "none";
            }
        });

        passwordInput.addEventListener("blur", function() {
            const passwordValue = passwordInput.value; 

            if (!regex.test(passwordValue)) {
                passwordHint.style.display = "none";
                passwordInput.classList.add("is-invalid");
            } else {
                passwordHint.style.display = "none";
                passwordInput.classList.remove("is-invalid");
            }
        });

        // KONFIRMASI PASSWORD
        const ulangiPassword = document.getElementById('ulangiPassword');
        const passwordBaru = document.getElementById('password');
        const ulangiPasswordFeedback = document.getElementById('ulangiPasswordFeedback');

        $('#ulangiPasswordLabel, #ulangiPassword').hide();
        // KALO PANJANG ULANGIPASSWORD = 0
        ulangiPassword.addEventListener('keyup', () => {
        if (ulangiPassword.value.length > 0) {
            if (ulangiPassword.value === passwordBaru.value) {
                ulangiPassword.classList.remove('is-invalid');
                $('#ulangiPasswordFeedback').hide();
            } else {
                ulangiPassword.classList.add('is-invalid');
                $('#ulangiPasswordFeedback').show();
            }
        } else {
            ulangiPassword.classList.remove('is-invalid');
            $('#ulangiPasswordFeedback').hide();
        }
        });
        // KALO FIELD PASSWORD LEBIH DARI 0 MAKA TAMPILKAN
        passwordBaru.addEventListener('keyup', function() {
            if (this.value.length > 0) {
                $('#ulangiPasswordLabel, #ulangiPassword').show();
            } else {
                $('#ulangiPasswordLabel, #ulangiPassword, #ulangiPasswordFeedback').hide();
                ulangiPassword.value = '';
                ulangiPassword.classList.remove('is-invalid');
            }
        });

        ulangiPassword.addEventListener("click", function() {
            if (ulangiPassword.value != passwordBaru.value) {
                ulangiPasswordFeedback.style.display = "block";
                ulangiPassword.classList.add('is-invalid');
            } else {
                ulangiPasswordFeedback.style.display = "none";
                ulangiPassword.classList.remove('is-invalid');
            }
            
        })

        ulangiPassword.addEventListener("blur", function() {
            ulangiPasswordFeedback.style.display = "none";
        })
        
        // NUPTK
        const nuptkInput = document.getElementById("nuptkInput");
        const nuptkHint = document.getElementById("nuptkHint")

        nuptkInput.addEventListener("input", function() {
            // console.log(nuptkInput.value.length);
            if (nuptkInput.value.length < 16) {
                nuptkHint.style.display = "block";
                nuptkInput.classList.add("is-invalid");
            } else {
                nuptkHint.style.display = "none";
                nuptkInput.classList.remove("is-invalid");
            }
        });

        nuptkInput.addEventListener("click", function() {
            if (nuptkInput.value.length < 16) {
                nuptkHint.style.display = "block";
                nuptkInput.classList.add("is-invalid");
            } else {
                nuptkHint.style.display = "none";
            }
        });

        nuptkInput.addEventListener("blur", function() {
            nuptkHint.style.display = "none"; 
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