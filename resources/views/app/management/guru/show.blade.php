@extends('adminlte::page')

@section('title', 'Detail guru')
@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)
@section('dashboard_url', 'Lihat Guru')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Detail Guru</h1>
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
                <div class="col-md-6"><img src="{{ url('public/images/'.$user->foto) }}" style="max-width: 100%; height: auto;"></div>
                <div class="col-md-6">{{ $user->name }}</div>
            </div>
            <!-- END FOTO DAN NAMA -->

            <!-- LABEL USERNAME & TEMPAT_LAHIR -->
            <div class="row mt-5">
                <label class="col-md-6">Username</label>
                <label class="col-md-6">Tempat Lahir</label>
            </div>
            <!-- END LABEL USERNAME & TEMPAT_LAHIR -->
            
            <!-- USERNAME & TEMPAT LAHIR -->
            <div class="row">
                <div class="col-md-6">{{ $user->username }}</div>
                <div class="col-md-6">{{ $user->tempat_lahir }}</div>
            </div>
            <!-- END USERNAME & TEMPAT LAHIR -->

            <!-- LABEL TANGGAL LAHIR & JENIS KELAMIN -->
            <div class="row mt-5">
                <label class="col-md-6">Tanggal Lahir</label>
                <label class="col-md-6">Jenis Kelamin</label>
            </div>
            <!-- END LABEL USERNAME & TEMPAT_LAHIR -->

            <!-- TANGGAL LAHIR & JENIS KELAMIN -->
            <div class="row">
                <div class="col-md-6">{{ $user->tanggal_lahir }}</div>
                <div class="col-md-6">{{ $user->jenis_kelamin }}</div>
            </div>
            <!-- END TANGGAL LAHIR & JENIS KELAMIN -->

            <!-- LABEL RFID & NUPTK -->
            <div class="row mt-5">
                <label class="col-md-6">RFID</label>
                <label class="col-md-6">NUPTK</label>
            </div>
            <!-- END LABEL RFID & NUPTK -->

            <!-- RFID & NUPTK -->
            <div class="row">
                <div class="col-md-6">{{ $user->rfid }}</div>
                <div class="col-md-6">{{ $user->NUPTK }}</div>
            </div>
            <!-- END RFID & NUPTK -->

            <div class="d-flex flex-row justify-content-between mt-3">
                <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                <x-adminlte-button class="btn bg-dark" label="Save" type="submit"></x-adminlte-button>
            </div>
        </div>
    </div>
@stop

@section('js')
    <!-- DIDAHULUKAN KARENA DI DALAM tanggal.js MEMANGGIL VARIABLE DI DALAM localTime.js -->
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script> 
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
@stop