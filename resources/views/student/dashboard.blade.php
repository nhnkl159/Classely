@extends('layouts.master') 

@section('cssfiles')
@include('assets.css.student.dashboard')
@stop

@section('content')
<!--This is the pages links -->
<div class="row gutters-tiny js-appear-enabled animated fadeIn" data-toggle="appear">
    <div class="col-6 col-md-4 col-xl-2">
        <a class="block block-link-shadow text-center text-white bg-gd-lake" href="/studentscontact/">
            <div class="block-content">
                <p class="mt-5">
                    <i class="fa fa-vcard fa-3x"></i>
                </p>
                <p class="font-w600">דף קשר כיתתי</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <a class="block block-link-shadow text-center text-white bg-gd-sun" href="/student/attendance">
            <div class="block-content">
                <p class="mt-5">
                    <i class="fa fa-eye fa-3x"></i>
                </p>
                <p class="font-w600">נוכחות</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <a class="block block-link-shadow text-center text-white bg-black-op-75" href="be_pages_generic_inbox.html">
            <div class="block-content">
                <p class="mt-5">
                    <i class="fa fa-archive fa-3x"></i>
                </p>
                <p class="font-w600">שיעורי בית</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <a class="block block-link-shadow text-center text-white bg-gd-dusk" href="be_pages_generic_inbox.html">
            <div class="block-content">
                <p class="mt-5">
                    <i class="fa fa-list-ul fa-3x"></i>
                </p>
                <p class="font-w600">ציונים שוטפים</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <a class="block block-link-shadow text-center text-white bg-corporate" href="be_pages_generic_inbox.html">
            <div class="block-content">
                <p class="mt-5">
                    <i class="fa fa-list-alt fa-3x"></i>
                </p>
                <p class="font-w600">רשימת מבחנים אונליין</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <a class="block block-link-shadow text-center text-white bg-pulse" href="be_pages_generic_inbox.html">
            <div class="block-content">
                <p class="mt-5">
                    <i class="fa fa-ban fa-3x"></i>
                </p>
                <p class="font-w600">אירועי משמעת ותפקוד</p>
            </div>
        </a>
    </div>
</div>
<!-- Some data -->
<div class="row invisible" data-toggle="appear">
    <!-- Row #1 -->
    <div class="col-6 col-xl-3">
        <a class="block block-link-shadow text-right" href="javascript:void(0)">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10 d-none d-sm-block">
                    <i class="si si-globe fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600 mb-0" data-toggle="countTo" data-to="250">0</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">ממוצע ציונים הסמסטר</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-xl-3">
        <a class="block block-link-shadow text-right" href="javascript:void(0)">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10 d-none d-sm-block">
                    <i class="si si-wallet fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600 mb-0" data-toggle="countTo" data-to="250">0</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">אירועי משמעת הסמסטר</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-xl-3">
        <a class="block block-link-shadow text-right" href="javascript:void(0)">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10 d-none d-sm-block">
                    <i class="si si-envelope-open fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600 mb-0" data-toggle="countTo" data-to="250">0</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">מבחנים סה"כ הסמסטר</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-xl-3">
        <a class="block block-link-shadow text-right" href="javascript:void(0)">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10 d-none d-sm-block">
                    <i class="si si-users fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600 mb-0" data-toggle="countTo" data-to="250">0</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">מבחנים אונליין ממתינים</div>
            </div>
        </a>
    </div>
    <!-- END Row #1 -->
</div>
<div class="row invisible" data-toggle="appear">
    <div class="col-xl-4 col-xs-12">
        <div class="col-12">
            <div class="block">
                <div class="block-header block-header-default">
                    <h1 class="block-title">
                        תרשים נוכחות
                    </h1>
                </div>
                <div class="block-content">
                    <canvas class="js-chartjs-pie"></canvas>
                </div>
            </div>

        </div>
        <div class="col-12">
            <div class="block">
                <div class="block-header block-header-default">
                    <h1 class="block-title">
                        הודעות אחרונות
                    </h1>
                </div>
                <div class="block-content">
                    <table class="table table-hover">
                        <tbody>
                            {!! csrf_field() !!}
                            @foreach($messages as $message)
                            <tr id="noticeboard_read" data-toggle="modal" data-target="#modal-message" data-id="{{$message->id}}">
                                <td>
                                    <p class="font-w600 mb-10">{{ $message->title }}</p>
                                    <p class="text-muted mb-0">{{ texttruncate($message->body) }}</p>
                                </td>
                                <td>
                                    <span class="badge badge-danger">הודעה כללית</span>
                                </td>
                                <td>
                                    <em class="text-muted">{{ humanTiming($message->created_at) }}</em>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="col-xl-8 col-xs-12">
        <div class="block block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">מערכת שעות</h3>
            </div>
            <div class="block-content">
                <div class="js-calendar"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">תצוגת הודעה כללית</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>  
                <div class="block-content">
                    <div class="row" id="dynamicData">
                    </div>
                    <div id="loader">
                        <div class="col-12">
                            <i class="fa fa-3x fa-cog fa-spin float-left"></i>
                            <h4 class="text-center">טוען פרטי הודעה כללית</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">צא</button>
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
<script src="{{ asset('assets/js/plugins/flot/jquery.flot.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flot/jquery.flot.pie.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flot/jquery.flot.stack.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flot/jquery.flot.resize.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/be_comp_charts.js') }}"></script>
@include('assets.js.student.dashboard')
@include('assets.js.global.noticeboard')
@include('assets.js.global.routine')
@stop
