@extends('adminlte::page')

@section('title', 'Peran')
@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)
@section('dashboard_url', 'Peran')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Peran</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>
    
    <div class="d-flex justify-content-between mx-1 mt-3">
        <div>
            <a href="{{ route('role.create') }}" class="btn bg-dark">Tambah Peran</a>
        </div>
        <span id="time" class="jam align-self-center"></span>
    </div>
@stop

@section('content')
    @php

    $heads = [['label' => 'No.', 'width' => 5], 'Peran', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
    $i = 1;
    $newroles = [];
    foreach ($role as $roles) {
        $btnEdit = auth()
        ->user()
        ->can('edit-role')
        ? '<a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" href="'.route('role.edit', $roles->id).'"><i class="fa fa-lg fa-fw fa-pen"></i></a>'
        : '';
        $btnDelete = auth()
        ->user()
        ->can('delete-kompetensi')
        ? '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" type="submit"><i class="fa fa-lg fa-fw fa-trash"></i></button>'
        : '';

        $btnDetails = '<a class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details" href="'.route('role.show', $roles->id).'"><i class="fa fa-lg fa-fw fa-eye"></i></a>';

        if ($roles->name === 'super admin') {
        $newRoles[] = [$i++, $roles->name, '<form class="d-flex justify-content-center">' . csrf_field()  . $btnDetails . '</form>'];
        } else {
        $newRoles[] = [$i++, $roles->name, '<form onsubmit="return confirm(\'Apakah Anda Yakin?\')" class="d-flex justify-content-center" method="POST" action="' . route('role.destroy', $roles->id) . '">' . csrf_field() . '<input type="hidden" name="_method" value="DELETE"/>' . $btnEdit . $btnDelete . $btnDetails . '</form></nobr>'];
        }
    }


    $config = [
        'data' => $newRoles,
        'order' => [[1, 'asc']],
        'columns' => [null, null, ['orderable' => false]],
    ];
    @endphp

    <div class="card mt-2">
        <div class="card-body">
            <x-adminlte-datatable :config="$config" :heads="$heads" head-theme="dark" id="roleTable" theme="light" hoverable bordered beautify>
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