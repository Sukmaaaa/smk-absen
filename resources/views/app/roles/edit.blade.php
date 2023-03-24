@extends('adminlte::page')

@section('title', 'Edit Peran')
@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)
@section('dashboard_url', 'Edit Peran')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Edit Peran</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>
    
    <div class="d-flex justify-content-end">
        <span id="time" class="jam"></span>
    </div>
@stop

@section('content')
    <form action="{{ route('role.update', $role->id) }}" method="POST" class="container">
            @csrf
            @method('PUT')

            <div class="card">

                <div class="card-body">
                    <label>Nama Role</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                    <x-adminlte-input type="text" name="name" placeholder="admin" value="{{ $role->name }}" title="Isi nama role">
                    </x-adminlte-input>

                    <label class="mb-2 mt-1">Permission:</label>
                    @foreach($permissions as $key => $permission)
                        @if($key % 4 == 0)
                            <div class="row d-flex">
                        @endif
                        <div class="icheck-primary col-md-3">
                            <input type="checkbox" name="permission[]" id="{{ $permission->name }}" value="{{ $permission->name }}" {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                            <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                        </div>
                        @if(($key + 1) % 4 == 0 || ($key + 1) == count($permissions))
                            </div>
                        @endif
                    @endforeach

                    <div class="d-flex flex-row justify-content-between mt-3">
                        <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                        <x-adminlte-button class="btn bg-dark" label="Save" type="submit"></x-adminlte-button>
                    </div>
                </div>
            </div>
    </form>
@stop

@section('js')
    <!-- DIDAHULUKAN KARENA DI DALAM tanggal.js MEMANGGIL VARIABLE DI DALAM localTime.js -->
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script> 
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
@stop