@extends('adminlte::page')

@section('title', 'Absensi Murid')
@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)
@section('dashboard_url', 'Murid Absensi')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Absensi Murid</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>

    <div class="d-flex justify-content-between mx-1 mt-3">
        <div>
            <a href="{{ route('murid.create') }}" class="btn bg-dark">Tambah absen hadir</a>
            <a href="{{ route('murid.edit') }}" class="btn bg-dark ms-5">Tambah absen pulang</a>
        </div>

        <span id="time" class="jam align-self-center"></span>
    </div>
@stop

@section('content')
    @php

    $heads = ['No.', 'Nama Murid'];
    $i = 1;
    $newAbsensi = [];
    foreach ($absensi as $absensis) {
        $btnDetails = '<a class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details" href="'.route('murid.index', $absensis->id).'">';

        $newAbsensi[] = [$i++, $absensis->murid->name];
    }

    $config = [
    'data' => $newAbsensi,
    'order' => [[1, 'asc']],
    'columns' => [null, ['orderable' => false]],
    ];
    @endphp

    <div class="card mt-2">
        <div class="card-body">
            <x-adminlte-datatable :config="$config" :heads="$heads" head-theme="dark" id="absensiTable" theme="light" hoverable bordered beautify>
                @foreach ($config['data'] as $row)
                <tr>
                    @foreach ($row as $cell)
                    <td>{!! $cell !!}</td>
                    @endforeach
                </tr>
                @endforeach
            </x-adminlte-datatable>
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
@stop