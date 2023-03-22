@extends('adminlte::page')

@section('title', 'Detail')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
@stop

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Detail</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>

    <div class="d-flex justify-content-end">
        <span id="time" class="jam"></span>
    </div>
@stop

@section('content')
        <div class="card">
            <div class="card-body">
                <!-- NAMA KOMPETENSI -->
                <label>Nama Kompetensi</label>
                <div>{{ $kompetensi->namaKompetensi }}</div>
                <!-- END NAMA KOMPETENSI -->

                <!-- DESKRIPSI KOMPETENSI -->
                <label class="mt-5">Deskripsi</label>
                <div>{{ $kompetensi->deskripsi }}</div>
                <!-- END DESKRIPSI KOMPETENSI -->

                <!-- TOMBOL KEMBALI -->
                <div class="row">
                    <a href="{{ route('kompetensi.index') }}" class="btn btn-primary mt-4 col-md-12">Kembali</a>
                </div>
                <!-- END TOMBOL KEMBALI -->
            </div>
        </div>    
@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
@stop