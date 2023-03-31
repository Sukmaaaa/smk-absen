@extends('adminlte::page')

@section('title', 'Absensi Guru')
@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)
@section('dashboard_url', 'Guru Absensi')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Absensi Guru</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>
    
    <div class="d-flex justify-content-between mx-1 mt-3">
        <div>
            @if (auth()->user()->can('create-kehadiran-guru'))
            <a href="{{ route('guru.create') }}" class="btn bg-dark">Tambah absen hadir</a>
            @endif
            @if (auth()->user()->can('edit-kehadiran-guru'))
            <a href="{{ route('guru.edit') }}" class="btn bg-dark ms-5">Tambah absen pulang</a>
            @endif
        </div>
        <span id="time" class="jam align-self-center"></span>
    </div>
@stop

@section('content')
    @php

    $heads = ['No.', 'Nama Guru', 'Absen Hadir'];
    $i = 1;
    $newAbsensi = [];
    foreach ($absensi as $absensis) {
        $btnDetails = '<a class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details" href="'.route('guru.index', $absensis->id).'">';

        $newAbsensi[] = [$i++, $absensis->user->name, $absensis->absen_hadir];
    }

    $config = [
    'data' => $newAbsensi,
    'order' => [[1, 'asc']],
    'columns' => [null, null, ['orderable' => false]],
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


@section('js')
    <!-- DIDAHULUKAN KARENA DI DALAM tanggal.js MEMANGGIL VARIABLE DI DALAM localTime.js -->
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script> 
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
@stop