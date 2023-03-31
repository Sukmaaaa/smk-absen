@extends('adminlte::page')

@section('title', 'Profil')
@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)
@section('dashboard_url', 'Profil')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Profil</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>
    
    <div class="d-flex justify-content-end mx-1">
        <span id="time" class="jam"></span>
    </div>

    <style>
        img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            object-position: center;
            justify-content: center;
        }

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

@section('content')

    <div class="card mt-2">
        <div class="card-body">
            <form action="{{ route('profil.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <!-- FOTO PROFIL  -->
                    <div class="row">
                        <div class="d-flex flex-row container justify-content-center">
                            <img src="{{ url('public/images/'.$user->foto) }}" class="rounded-circle flex-wrap">
                        </div>
                    </div>
                    <!-- END FOTO PROFIL -->

                    <!-- FOTO & NAMA -->
                    <div class="row mt-3">
                            <x-adminlte-input-file name="foto" label="Foto" placeholder="Pilih foto" :accept="'image/*'" :max-file-size="1000" :validation-style="'outlined'" id="input-foto" fgroup-class="col-md-6" title="Pilih foto">
                            </x-adminlte-input-file>

                        <div class="col-md-6">
                            <label>Nama</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                            <x-adminlte-input type="text" name="name" placeholder="Windah" title="Isi nama" required value="{{ old('name', $user->name) }}"></x-adminlte-input>
                        </div>
                    </div>
                    <!-- END FOTO & NAMA -->

                    <!-- USERNAME & TEMPAT LAHIR -->
                    <div class="row">
                        <div class="col-md-6">
                            <label>Username</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                            <x-adminlte-input type="text" name="username" placeholder="Brando" title="Isi username" required value="{{ old('username', $user->username) }}"></x-adminlte-input>
                        </div>

                        <div class="col-md-6">
                            <label>Tempat Lahir</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                            <x-adminlte-select name="tempat_lahir" class="select2 form-control" title="Pilih tempat lahir" style="height: 38px;" required>
                                <option value="" disabled selected>Pilih tempat lahir</option>
                                @foreach($kabupatenKota as $kabupatenKotas)
                                    <option value="{{ $kabupatenKotas->name }}" {{ old('tempat_lahir') == $kabupatenKotas->name ? 'selected' : '' }}>{{ $kabupatenKotas->name }}</option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                    </div>
                    <!-- END USERNAME & TEMPAT LAHIR -->

                    <!-- TANGGAL LAHIR & JENIS KELAMIN -->
                    <div class="row">
                        <div class="col-md-6">
                            <label>Tanggal Lahir</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                            <x-adminlte-input type="date" name="tanggal_lahir" class="form-control" title="Isi tanggal lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" required>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-6">
                            <label>Jenis Kelamin</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                            <x-adminlte-select name="jenis_kelamin" title="Pilih jenis kelamin" value="{{ old('jenis_kelamin') }}" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </x-adminlte-select>
                        </div>
                    </div>
                    <!-- END TANGGAL LAHIR & JENIS KELAMIN -->

                    <!-- PASSWORD BARU & KONFIRMASI PASSWORD BARU -->
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
                    <!-- END PASSWORD BARU & KONFIRMASI PASSWORD BARU -->

                    <!-- TOMBOL SIMPAN -->
                    <button class="btn btn-primary mt-3 col-md-12" type="submit">Simpan</button>
                    <!-- END TOMBOL SIMPAN -->
                </div>
            </form>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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
        @if(Session::has('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ Session::get('success') }}'
            })
        @endif
    </script>
@stop