@extends('adminlte::page')

@section('title', 'Tambah absen pulang')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
@stop

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Tambah absen pulang</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>

    <div class="d-flex justify-content-end">
        <span id="time" class="jam"></span>
    </div>
@stop

@section('content')
        <div class="card">
            <div class="card-body">
                 <form action="{{ route('guru.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <!-- SEARCH -->
                        <label>RFID Guru</label><label class="fw-bold" style="color:red; font-weight:">*</label>
                        <input type="text" class="form-control" id="inputRFID" placeholder="0x82 1x2d 21dp 92x1" name="rfid_guru">
                        <div class="mt-2" id="responses"></div>
                        
                        <!-- LABEL FOTO DAN NAMA -->
                        <div class="row mt-4">
                            <label class="col-md-6">Foto</label>
                            <label class="col-md-6">Nama Guru</label>
                        </div>
                        <!-- END LABEL FOTO DAN NAMA -->

                        <!-- HASIL FOTO & NAMA -->
                        <div class="row">
                            <div class="col-md-6" id="resultFoto"></div>
                            <div class="col-md-6" id="resultNama"></div>
                        </div>
                        <!-- END HASIL FOTO & NAMA -->

                        <!-- LABEL KOMPETENSI & JENIS KELAMIN -->
                        <div class="row mt-4">
                            <label class="col-md-6">Kompetensi</label>
                            <label class="col-md-6">Jenis Kelamin</label>
                        </div>
                        <!-- END LABEL KOMPETENSI & JENIS KELAMIN -->

                        <!-- HASIL KOMPETENSI -->
                        <div class="row mb-3">
                            <div class="col-md-6" id="resultKompetensi"></div>
                            <div class="col-md-6" id="resultJenisKelamin"></div>
                        </div>
                        <!-- END HASIL KOMPETENSI -->


                        <!-- LOCAL TIME HADIR -->
                        <input type="datetime-local" id="inputLocalTime" name="inputLocalTimePulang">
                        
                        <!-- TOMBOL SIMPAN & KEMBALI -->
                        <footer class="mt-4">
                            <div class="d-flex flex-row justify-content-between">
                                <a href="{{ route('guru.index') }}" class="btn btn-default">Kembali</a>
                                <x-adminlte-button class="btn bg-dark" label="Simpan" type="submit"></x-adminlte-button>
                            </div>
                        </footer>
                        <!-- END TOMBOL SIMPAN & KEMBALI -->
                    </div>
                </form>
                <!-- ENDFORM PULANG -->
            </div>
        </div>    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <!-- DIDAHULUKAN KARENA DI DALAM tanggal.js MEMANGGIL VARIABLE DI DALAM localTime.js -->
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script> 
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#inputRFID").trigger("focus"); // FOCUS PADA ELEMENT
    </script>
    <script>
        const rfid = $('#inputRFID')
        const responses = $('#responses')
        const resultFoto = $('#resultFoto')
        const resultNama = $('#resultNama')
        const resultKompetensi = $('#resultKompetensi')
        const resultJenisKelamin = $('#resultJenisKelamin')
        const inputLocalTime = $('#inputLocalTime')
        let dataTerkirim = false;

        // LIVESEARCH
        $(document).ready(() => {
            readData()
            rfid.keyup(() => {
                
            $('#responses, #resultFoto, #resultNama, #resultKompentensi, #resultJenisKelamin').html('')
            if (!rfid.val()) return readData()

            responses.html('<p class="text-muted">Mencari data...</p>')

                $.ajax({
                    type: 'get',
                    url: "{{ url('action') }}",
                    data: {
                    'rfid': rfid.val()
                    },
                    success: (data) => {
                    const res = JSON.parse(data)
                    
                    // CONSOLE PANJANG INPUTAN
                    console.log(rfid.val().length);

                    // JIKA DATA TIDAK ADA
                    if (res.error) {
                        resultFoto.html("-")
                        resultNama.html("-")
                        resultKompetensi.html("-")
                        resultJenisKelamin.html("-")

                        // JIKA PANJANG RFID == 19 MAKA KIRIM OTOMATIS
                        if (rfid.val().length == 19 && !dataTerkirim) {
                            dataTerkirim = true;
                            $('button[type="submit"]').click();
                        }

                        return responses.html(res.msg)
                    } else {
                        resultFoto.html(res.foto)
                        resultNama.html(res.name)
                        resultKompetensi.html(res.kompetensi)
                        resultJenisKelamin.html(res.jenis_kelamin)

                        // MENAMPILKAN WAKTU LOKAL
                        const d = new Date();
                        const year = d.getFullYear();
                        const month = (d.getMonth() + 1).toString().padStart(2, '0'); // TAMBAHKAN 1 KARENA INDEX BULAN DIMULAI DARI 0, LALU PADLEFT 0 JIKA KURANG DARI 10
                        const date = d.getDate().toString().padStart(2, '0'); // PEDLEFT 0 JIKA KURANG DARI 10
                        const hours = d.getHours().toString().padStart(2, '0'); // PADLEFT 0 JIKA KURANG DARI 10
                        const minutes = d.getMinutes().toString().padStart(2, '0'); // PADLEFT 0 JIKA KURANG DARI 10
                        const formattedDatetime = `${year}-${month}-${date}T${hours}:${minutes}`;
                        inputLocalTime.val(formattedDatetime);

                        // JIKA PANJANG RFID == 19 MAKA KIRIM OTOMATIS
                        if (rfid.val().length == 19 && !dataTerkirim) {
                                dataTerkirim = true;
                                $('button[type="submit"]').click();
                        }
                    }

                    // MENGOSONGKAN inputLocalTime VALUE JIKA RESULT ERROR
                    if (res.error) {
                        inputLocalTime.val('')
                    }

                    $("#responses").hide()
                    }
                    
                    
                })
                $("#responses").show()
                })

        })

        // BACA DATA
        function readData() {
            $.get("{{ url('hasil') }}", {}, function (data, status) {
            $('#resultFoto, #resultNama, #resultKompetensi, #resultJenisKelamin').html('-')
            inputLocalTime.val('')
            })
        }
    </script>


    <script>
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