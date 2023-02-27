@extends('adminlte::page')

@section('title', 'Tambah absen hadir')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
@stop

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Tambah absen hadir</h1>
        <span id="time" class="jam"></span>
    </div>
@stop

@section('content')
        <div class="card">
            <div class="card-body">
                <!-- FORM KEHADIRAN -->
                <!-- <form action="{{ route('guru.store') }}" method="POST">
                    @csrf
                    <div class="form-group"> -->
                        <!-- SEARCH -->
                        <!-- <label>RFID Guru</label><label class="fw-bold" style="color:red; font-weight:">*</label>
                        <input type="text" class="form-control" id="inputRFID" placeholder="0x82 1x2d 21dp 92x1" name="rfid_guru">
                        <div class="mt-2" id="responses"></div>
                        
                        <div class="row mt-4">
                            <label class="col-md-6">Nama Guru</label>
                            <label class="col-md-6">Password</label>
                        </div> -->

                        <!-- HASIL -->
                        <!-- <div class="row">
                            <div class="col-md-6" id="resultNama"></div>
                            <div class="col-md-6" id="resultPassword"></div>
                        </div> -->

                        <!-- <input type="time" step=1 value="" id="inputLocalTime"></input> -->

                        <!-- LOCAL TIME HADIR -->
                        <!-- <input type="datetime-local" id="inputLocalTime" name="inputLocalTime"> -->
                        
                        <!-- TOMBOL SIMPAN & KEMBALI -->
                        <!-- <footer class="mt-4">
                            <div class="d-flex flex-row justify-content-between">
                                <a href="{{ url()->previous() }}" class="btn btn-default">Kembali</a>
                                <x-adminlte-button class="btn bg-dark" label="Simpan" type="submit"></x-adminlte-button>
                            </div>
                        </footer>
                    </div>
                </form> -->
                <!-- END FORM KEHADIRAN -->

                <!-- FORM PULANG -->
                <form action="{{ route('guru.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <!-- SEARCH -->
                        <label>RFID Guru</label><label class="fw-bold" style="color:red; font-weight:">*</label>
                        <input type="text" class="form-control" id="inputRFID" placeholder="0x82 1x2d 21dp 92x1" name="rfid_guru">
                        <div class="mt-2" id="responses"></div>
                        
                        <div class="row mt-4">
                            <label class="col-md-6">Nama Guru</label>
                            <label class="col-md-6">Password</label>
                        </div>

                        <div class="row">
                            <!-- HASIL -->
                            <div class="col-md-6" id="resultNama"></div>
                            <div class="col-md-6" id="resultPassword"></div>
                        </div>

                        <!-- <input type="time" step=1 value="" id="inputLocalTime"></input> -->

                        <!-- LOCAL TIME HADIR -->
                        <input type="datetime-local" id="inputLocalTime" name="inputLocalTimePulang">
                        
                        <!-- TOMBOL SIMPAN & KEMBALI -->
                        <footer class="mt-4">
                            <div class="d-flex flex-row justify-content-between">
                                <a href="{{ url()->previous() }}" class="btn btn-default">Kembali</a>
                                <x-adminlte-button class="btn bg-dark" label="Simpan" type="submit"></x-adminlte-button>
                            </div>
                        </footer>
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
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const rfid = $('#inputRFID')
        const responses = $('#responses')
        const resultNama = $('#resultNama')
        const resultPassword = $('#resultPassword')

            // LIVESEARCH
            $(document).ready(() => {
                readData();
                rfid.keyup(() => {
                    $('#responses, #resultNama, #resultPassword').html('')
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
                            
                            // KALO GAADA DATANYANYA 
                            if (res.error) {
                                resultNama.html("-")
                                resultPassword.html("-")
                                return responses.html(res.msg)
                            }
                            
                            
                            
                            resultNama.html(res.name)
                            resultPassword.html(res.password)
                            $("#responses").hide();

                        }
                    })
                    $("#responses").show();
                })
            })

            function readData() {
                $.get("{{ url('hasil') }}", {}, 
                
                function(data, status){
                    $('#resultNama, #resultPassword').html('')
                });
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

    <!-- JIKA INPUT RFID PANJANGNYA KURANG DARI 14 LOCAL TIME SLEEP -->
    <script>

        // if (rfid.length < 14) {
        //     document.getElementById("inputLocalTime").value = "";
        // } else {
        //     console.log("aowkkw");
        // }
        // while (rfid.length < 14) {
        //     document.getElementById("inputLocalTime").value = "";
        // }
        const inputLocalTime = $('#inputLocalTime')
        
        // $("#inputLocalTime").hide();

        $('#inputRFID').on('keyup', () => {
            if (rfid.val().length < 10) {
                document.getElementById("inputLocalTime").value = "";
            } else {
                document.getElementById("inputLocalTime").value = valueLocalTime;
                // $("#inputLocalTime").show();
            }
        })
    </script>

    <!-- COBA KALO RFID LENGTH <  -->
    <!-- <script>
        const rfid = $('#inputRFID')
        const responses = $('#responses')
        const resultNama = $('#resultNama')
        const resultPassword = $('#resultPassword')


    </script> -->

    
@stop