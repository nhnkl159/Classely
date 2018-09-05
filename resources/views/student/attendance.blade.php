@extends('layouts.master') 

@section('cssfiles')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/fullcalendar/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
@stop

@section('content')
<div class="bg-primary">
    <div class="bg-pattern bg-black-op-25" style="background-image: url('{{ asset('assets/img/various/bg-pattern.png') }}')">
        <div class="content content-top text-center">
            <h1 class="font-w700 text-white mb-10">נוכחות</h1>
            <h2 class="h4 font-w400 text-white-op">כאן ניתן לראות את נוכחותך במהלך השנה.</h2>
        </div>
    </div>
</div>
<div class="row invisible" data-toggle="appear">
    <div class="col-xl-12 col-xs-12">
        <div class="block block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">נוכחות</h3>
            </div>
            <div class="block-content">
                <div class="js-calendar"></div>
            </div>
        </div>
    </div>
</div>
@stop

@section('jsfiles')
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/fullcalendar/locale/he.js') }}"></script>

<script src="{{ asset('assets/js/plugins/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@include('assets.js.student.attendance')
@stop
