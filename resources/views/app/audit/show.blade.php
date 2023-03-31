@extends('adminlte::page')

@section('title', 'audit detail') 
@section('dashboard_url', 'auditLog')

@section('content_header')
    <div class="row justify-content-between mx-1">
        <h1>Detail</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>

    <div class="d-flex justify-content-end">
        <span id="time" class="jam"></span>
    </div>
@endsection

@section('content') 

@php
    $audits = $audit;
    $user = $audits->user_type;    
@endphp
    
    <div class="card">
            <div class="card-body">

                <div class="row md-6">
                    <label class="col">User</label>
                    <label class="col">Event</label>
                </div>

                <div class="row md-6">
                    <div class="col">{{ $user::find($audits->user_id)->name }}</div>
                    <div class="col">{{ $audit->event}}</div>
                </div>
                
                <div class="row md-6 mt-5">
                    <label class="col">Ip</label>
                    <label class="col">Url</label>
                </div>
                
                <div class="row md-6">
                    <div class="col">{{ $audit->ip_address}}</div>
                    <div class="col">{{ $audit->url}}</div>
                </div>

                <div class="row md-6 mt-5">
                    <label class="col">Nilai Lama</label>
                    <label class="col">Nilai Baru</label>
                </div>

                <div class="row md-6 d-flex flex-wrap">
                    <div class="col-6">
                        @foreach($audits->old_values as $key => $value)
                        {{ $key .':' . $value;}} <br/>
                        @endforeach
                    </div>
                    <div class="col-6">
                        @foreach($audits->new_values as $key => $value)
                        {{ $key .':' . $value;}} <br/>
                        @endforeach
                    </div>
                </div>                

                <div class="row mt-5">
                    <label class="col">Created at</label>
                    <label class="col">Updated at</label>
                </div>
                
                <div class="row">
                    <div class="col">{{$audit->created_at}}</div>
                    <div class="col">{{$audit->updated_at}}</div>
                </div>

                <div class="row">  
                    <a href="{{ route('audit.index') }}" class="btn btn-primary container mt-4 col-md-12">Kembali</a> 
                </div>
            </div>
        </div>

            
@endsection

@section('js')
    <!-- DIDAHULUKAN KARENA DI DALAM tanggal.js MEMANGGIL VARIABLE DI DALAM localTime.js -->
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script> 
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
@stop