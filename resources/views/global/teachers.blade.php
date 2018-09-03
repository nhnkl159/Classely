@extends('layouts.master') 
@section('cssfiles')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}"> 
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}"> 
<link rel="stylesheet" href="{{ asset('assets/js/plugins/dt-responsive/responsive.bootstrap.min.css') }}"> 
@stop 
@section('content')
<div class="bg-primary">
    <div class="bg-pattern bg-black-op-25" style="background-image: url('{{ asset('assets/img/various/bg-pattern.png') }}')">
        <div class="content content-top text-center">
            <h1 class="font-w700 text-white mb-10">רשימת מורים</h1>
            <h2 class="h4 font-w400 text-white-op">כאן ניתן לראות את רשימת המורים המלמדים אותי בבית הספר.</h2>
        </div>
    </div>
</div>
<div class="content">
    <div class="row items-push py-30">
        <div class="col-md-12">

            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">דף קשר כיתתי</h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <code>שם בית ספר</code>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <table id="teachersTable" class="table table-bordered table-hover table-vcenter dt-responsive nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">מזהה</th>
                                <th class="text-center">שם המורה</th>
                                <th class="text-center">מין</th>
                                <th class="text-center">דואר אלקטרוני</th>
                                <th class="text-center">מס' פאלפון</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@stop @section('jsfiles')
<script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dt-responsive/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dt-responsive/responsive.bootstrap.min.js') }}"></script>
@include('assets.js.global.teachers')
@stop