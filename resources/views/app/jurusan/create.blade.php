@extends('adminlte::page')

@section('title', 'Tambah jurusan')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
@stop

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Tambah jurusan</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>

    <div class="d-flex justify-content-end">
        <span id="time" class="jam"></span>
    </div>
@stop

@section('content')
        <div class="card">
            <div class="card-body">
                <!-- FORM JURUSAN -->
                <form action="{{ route('jurusan.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        
                        <!-- NAMA JURUSAN -->
                        <label>Nama jurusan</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                        <x-adminlte-input type="text" name="namaJurusan" placeholder="RPL" required title="Isi nama jurusan">
                        </x-adminlte-input>
                        <!-- END NAMA JURUSAN -->

                        <!-- DESKRIPSI -->
                        <x-adminlte-textarea name="deskripsi" label="Deskripsi" title="Isi deskripsi jurusan" placeholder="RPL adalah jurusan yang berfokus pada pengembangan perangkat lunak atau software. Dalam jurusan RPL murid akan mempelajari dasar-dasar pemrograman, analisis dan desain sistem, manajemen proyek perangkat lunak serta pengujian dan perawatan perangkat lunak." rows=5>
                        </x-adminlte-textarea>
                        <!-- END DESKRIPSI -->

                        <!-- TOMBOL SIMPAN & KEMBALI -->
                        <footer class="mt-4">
                            <div class="d-flex flex-row justify-content-between">
                                <a href="{{ route('jurusan.index') }}" class="btn btn-default">Kembali</a>
                                <x-adminlte-button class="btn bg-dark" label="Simpan" type="submit" id="form"></x-adminlte-button>
                            </div>
                        </footer>
                        <!-- END TOMBOL SIMPAN & KEMBALI -->
                    </div>
                </form>
                <!-- END FORM JURUSAN -->

            </div>
        </div>    
@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
@stop