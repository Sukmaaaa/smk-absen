@extends('adminlte::page')

@section('title', 'Audit')
@section('plugins.DatatablesPlugin', true)
@section('plugins.Datatables', true)
@section('dashboard_url', 'Audit')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Audit</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>
    
    <div class="d-flex justify-content-end mx-1">
        <span id="time" class="jam"></span>
    </div>
@stop

@section('content')
@php

    $heads = ['No.', 'User', 'Event', 'Url', 'Updated at', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
    $i = 1;
    $newAudit = [];
    foreach ($audit as $audits) {
        $user = $audits->user_type;
        $btnDetails = auth()
        ->user()
        ->can('view-audit')
        ? '<a class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details" href="'.route('audit.show', $audits->id).'"><i class="fa fa-lg fa-fw fa-eye"></i></a>'
        : '';
        $newAudit[] = [$i++, $user::find($audits->user_id)->name, $audits->event, $audits->url, $audits->updated_at, '<form class="d-flex justify-content-center">' . csrf_field()  . $btnDetails . '</form>'];
    }

    $config = [
        'data' => $newAudit,
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, null, null, ['orderable' => false]],
    ];
@endphp

    <div class="card mt-2">
        <div class="card-body">
            <x-adminlte-datatable :config="$config" :heads="$heads" head-theme="dark" id="auditTable" theme="light" hoverable bordered beautify>
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
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
@stop