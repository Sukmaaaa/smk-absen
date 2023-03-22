@extends('adminlte::page')

@section('title', 'Edit Kompetensi')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
@stop

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Edit Kompetensi</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>

    <div class="d-flex justify-content-end">
        <span id="time" class="jam"></span>
    </div>
@stop

@section('content')
        <div class="card">
            <div class="card-body">
                <!-- FORM KOMPETENSI -->
                <form action="{{ route('kompetensi.update', $kompetensi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        
                        <!-- NAMA KOMPETENSI -->
                        <label>Nama Kompetensi</label><span class="fw-bold" style="color:red; font-weight: bold">*</span>
                        <x-adminlte-input type="text" name="namaKompetensi" placeholder="Matematika" required value="{{ old('namaKompetensi', $kompetensi->namaKompetensi) }}">
                        </x-adminlte-input>
                        <!-- END NAMA KOMPETENSI -->

                        <!-- DESKRIPSI -->
                        <x-adminlte-textarea name="deskripsi" label="Deskripsi" placeholder="Matematika adalah ilmu yang mempelajari konsep, struktur, dan hubungan antara angka, ruang, besaran, dan pola." rows=5>
                        {{ old('deskripsi', $kompetensi->deskripsi) }}
                        </x-adminlte-textarea>
                        <!-- END DESKRIPSI -->
                        
                        <!-- TOMBOL SIMPAN & KEMBALI -->
                        <footer class="mt-4">
                            <div class="d-flex flex-row justify-content-between">
                                <a href="{{ route('kompetensi.index') }}" class="btn btn-default">Kembali</a>
                                <x-adminlte-button class="btn bg-dark" label="Simpan" type="submit" id="form"></x-adminlte-button>
                            </div>
                        </footer>
                        <!-- END TOMBOL SIMPAN & KEMBALI -->
                    </div>
                </form>
                <!-- END FORM KEHADIRAN -->

            </div>
        </div>    
@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
@stop