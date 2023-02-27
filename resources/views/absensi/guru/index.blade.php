@extends('adminlte::page')

@section('title', 'Absensi Guru')
@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)
@section('dashboard_url', 'Guru Absensi')

@section('content_header')
    <h1>Absensi Guru</h1>

    <div class="justify-content-between mx-1 mt-3">
        <a href="{{ route('guru.create') }}" class="btn bg-dark">Tambah absen hadir</a>
    </div>
@stop

@section('content')
    @php

    $heads = ['No.', 'Nama Guru', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
    $i = 1;
    $newAbsensi = [];
    foreach ($absensi as $absensis) {
        $btnDetails = '<a class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details" href="'.route('guru.index', $absensis->id).'"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
        $formActions = '<div class="d-flex justify-content-center">' . $btnEdit . ' ' . $btnDelete . ' ' . $btnDetails . '</div>';

        $newAbsensi[] = [$i++, '<img src="'.$absensis->cover.'" width="155px">', $absensis->title, $formActions ];
    }

    $config = [
    'data' => $newAbsensi,
    'order' => [[1, 'asc']],
    'columns' => [null, null, ['orderable' => false]],
    ];
    @endphp

    <div class="card mt-2">
        <div class="card-body">
            <x-adminlte-datatable :config="$config" :heads="$heads" head-theme="dark" id="animeTable" theme="light" hoverable bordered beautify>
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
    <script> console.log('Hi!'); </script>
@stop