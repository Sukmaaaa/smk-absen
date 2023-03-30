@extends('adminlte::page')

@section('title', 'Detail Murid')
@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)
@section('dashboard_url', 'Detail Murid')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Detail Murid</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>
    
    <div class="d-flex justify-content-end">
        <span id="time" class="jam"></span>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- LABEL FOTO & NAMA -->
            <div class="row">
                <label class="col-md-6">Foto</label>
                <label class="col-md-6">Nama</label>
            </div>
            <!-- END LABEL FOTO & NAMA -->

            <!-- FOTO DAN NAMA -->
            <div class="row">
                <div class="col-md-6"><img src="{{ url('public/images/'.$murid->foto) }}" style="max-width: 100%; height: auto;"></div>
                <div class="col-md-6">{{ $murid->nama }}</div>
            </div>
            <!-- END FOTO DAN NAMA -->

            <!-- LABEL TEMPAT LAHIR & TANGGAL LAHIR -->
            <div class="row mt-5">
                <label class="col-md-6">Tempat Lahir</label>
                <label class="col-md-6">Tanggal Lahir</label>
            </div>
            <!-- END LABEL TEMPAT LAHIR & TANGGAL LAHIR -->
            
            <!-- TEMPAT LAHIR & TANGGAL LAHIR -->
            <div class="row">
                <div class="col-md-6">{{ $murid->tempat_lahir }}</div>
                <div class="col-md-6">{{ $murid->tanggal_lahir }}</div>
            </div>
            <!-- END TEMPAT LAHIR & TANGGAL LAHIR -->

            <!-- LABEL KELAS & JURUSAN -->
            <div class="row mt-5">
                <label class="col-md-6">Kelas</label>
                <label class="col-md-6">Jurusan</label>
            </div>
            <!-- END LABEL KELAS & JURUSAN -->

            <!-- KELAS & JURUSAN -->
            <div class="row">
                <div class="col-md-6">{{ $murid->kelas }}</div>
                <div class="col-md-6">{{ $murid->jurusan }}</div>
            </div>
            <!-- END KELAS & JURUSAN -->

            <!-- LABEL RFID & JENIS KELAMIN -->
            <div class="row mt-5">
                <label class="col-md-6">RFID</label>
                <label class="col-md-6">Jenis Kelamin</label>
            </div>
            <!-- END LABEL RFID & JENIS KELAMIN -->

            <!-- RFID & JENIS KELAMIN -->
            <div class="row">
                <div class="col-md-6">{{ $murid->rfid }}</div>
                <div class="col-md-6">{{ $murid->jenis_kelamin }}</div>
            </div>
            <!-- END RFID & JENIS KELAMIN -->

            <!-- TOMBOL KEMBALI -->
            <div class="row">
                    <a href="{{ route('murid.index') }}" class="btn btn-primary mt-4 col-md-12">Kembali</a>
            </div>
            <!-- END TOMBOL KEMBALI -->
        </div>
    </div>
@stop

@section('js')
    <!-- DIDAHULUKAN KARENA DI DALAM tanggal.js MEMANGGIL VARIABLE DI DALAM localTime.js -->
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script> 
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
@stop