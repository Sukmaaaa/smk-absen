@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Dashboard</h1>
        <span id="tanggal" class="tanggal align-self-center"></span>
    </div>
    <div class="d-flex justify-content-end">
        <span id="time" class="jam"></span>
    </div>
@stop

@section('content')

    <!-- GRAFIK KETERLAMBATAN MURID -->
    <div class="card">
        <div class="card-body">
            <div class="box">
            <div class="box-header with-border">
                <div class="d-flex justify-content-between">
                    <h3 class="box-title">Keterlambatan Murid</h3>
                    <h3 id="bulan"></h3>
                </div>
            </div>
            <div class="box-body">
                <canvas id="chartTerlambat"></canvas>
            </div>
        </div>
        </div>
    </div>
    <!-- END GRAFIK KETERLAMBATAN MURID -->

    <!-- GRAFIK KETERLAMBATAN GURU -->
    <div class="card">
        <div class="card-body">
            <div class="box">
            <div class="box-header with-border">
                <div class="d-flex justify-content-between">
                    <h3 class="box-title">Keterlambatan Guru</h3>
                    <h3 id="bulans"></h3>
                </div>
            </div>
            <div class="box-body">
                <canvas id="chartTerlambatGuru"></canvas>
            </div>
        </div>
        </div>
    </div>
    <!-- END GRAFIK KETERLAMBATAN GURU -->

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/localTime.js') }}"></script> 
    <script type="text/javascript" src="{{ URL::asset('js/tanggal.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // AMBIL BULAN
        var month = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];

        var tanggalss = new Date();

        var months = month[tanggalss.getMonth()];

        document.getElementById("bulan").innerHTML = months;
        document.getElementById("bulans").innerHTML = months;
        // CHART JS MURID
        $(function () {
            $.ajax({
                url: '/absensi-terlambat',
                dataType: 'json',
                success: function (data) {
                    var chartTerlambat = new Chart($('#chartTerlambat'), {
                        type: 'line',
                        data: {
                            labels: Object.keys(data).map(function (week) { return ' ' + week; }),
                            datasets: [{
                                label: 'Jumlah Murid Terlambat',
                                data: Object.values(data),
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            });
        });
        // END CHART JS MURID

        // CHART JS GURU
        $(function () {
            $.ajax({
                url: '/absensi-terlambat-guru',
                dataType: 'json',
                success: function (data) {
                    var chartTerlambat = new Chart($('#chartTerlambatGuru'), {
                        type: 'line',
                        data: {
                            labels: Object.keys(data).map(function (week) { return ' ' + week; }),
                            datasets: [{
                                label: 'Jumlah Guru Terlambat',
                                data: Object.values(data),
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            });
        });
        // END CHART JS GURU
        


    </script>
@stop