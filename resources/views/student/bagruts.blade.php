@extends('layouts.master') 

@section('cssfiles')
<link rel="stylesheet" href="{{ asset('/assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}"> 
<link rel="stylesheet" href="{{ asset('assets/js/plugins/dt-responsive/responsive.bootstrap.min.css') }}"> 
<link rel="stylesheet" href="{{ asset('/assets/js/plugins/datetimepicker/jquery.datetimepicker.min.css') }}">
@stop

@section('content')
<div class="bg-primary">
    <div class="bg-pattern bg-black-op-25" style="background-image: url('{{ asset('assets/img/various/bg-pattern.png') }}')">
        <div class="content content-top text-center">
            <h1 class="font-w700 text-white mb-10">רשימת ציוני בגרויות</h1>
            <h2 class="h4 font-w400 text-white-op">כאן ניתן לראות את רשימת ציוני הבגרויות שלי במהלך השנה.</h2>
        </div>
    </div>
</div>
<div class="row invisible" data-toggle="appear">
    <div class="col-xl-12 col-xs-12">
        <div class="block block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">טבלת מבחני בגרות</h3>
            </div>
            <div class="block-content">
                <table id="bagrutsTable" class="table table-bordered table-hover table-vcenter dt-responsive nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">שם שאלון</th>
                            <th class="text-center">מקצוע</th>
                            <th class="text-center">מספר שאלון</th>
                            <th class="text-center">שאלון ראשי</th>
                            <th class="text-center">תאריך</th>
                            <th class="text-center">ציון הגשה</th>
                            <th class="text-center">ציון בחינת הבגרות</th>
                            <th class="text-center">ציון עבודה</th>
                            <th class="text-center">ציון סופי</th>
                            <th class="text-center">הערות</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('jsfiles')
<script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dt-responsive/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dt-responsive/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs/Chart.min.js') }}"></script>
@include('assets.js.student.bagruts')
@stop
