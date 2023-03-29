@extends('adminlte::page')

@section('title', 'Data Guru')
@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)
@section('dashboard_url', 'Data Guru')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Guru</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>
    
    <div class="d-flex justify-content-between mx-1 mt-3">
        @if (auth()->user()->can('create-user'))
            <a href="{{ route('management.guru.create') }}" class="btn bg-dark">Tambah Guru</a>
            <span id="time" class="jam"></span>
        @endif
    </div>
@stop

@section('content')
@php

    $heads = ['No.', 'Nama', 'RFID', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
    $i = 1;
    $newGuru = [];
    foreach ($user as $gurus) {
    $btnEdit = auth()
    ->user()
    ->can('edit-user')
    ? '<a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" href="'.route('management.guru.edit', $gurus->id).'"><i class="fa fa-lg fa-fw fa-pen"></i></a>'
    : '';
    $btnDelete = auth()
    ->user()
    ->can('delete-user')
    ? '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" type="submit"><i class="fa fa-lg fa-fw fa-trash"></i></button>'
    : '';
    $btnDetails = '<a class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details" href="'.route('management.guru.show', $gurus->id).'"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
    $newGuru[] = [$i++, $gurus->name, $gurus->rfid, '<form onsubmit="return confirm(\'Apa Kah Anda Yakin?\')" class="d-flex justify-content-center" method="POST" action="' . route('management.guru.destroy', $gurus->id) . '">' . csrf_field() . '<input type="hidden" name="_method" value="DELETE"/>' . $btnEdit . $btnDelete . $btnDetails . '</form></nobr>'];
    }

    $config = [
        'data' => $newGuru,
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];
@endphp

    <div class="card mt-2">
        <div class="card-body">
            <x-adminlte-datatable :config="$config" :heads="$heads" head-theme="dark" id="kompetensiTable" theme="light" hoverable bordered beautify>
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
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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