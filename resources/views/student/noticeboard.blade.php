@extends('layouts.master') 

@section('cssfiles')
<link rel="stylesheet" href="{{ asset('/assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
@stop

@section('content')
<div class="bg-primary">
    <div class="bg-pattern bg-black-op-25" style="background-image: url('{{ asset('assets/img/various/bg-pattern.png') }}')">
        <div class="content content-top text-center">
            <h1 class="font-w700 text-white mb-10">הודעות כלליות</h1>
            <h2 class="h4 font-w400 text-white-op">כאן ניתן לראות את ההודעות האחרונות של בית הספר ואירועים מסויימים.</h2>
        </div>
    </div>
</div>
<div class="content">
    <div class="row items-push py-30">
        <div class="col-12 mb-0 js-appear-enabled animated fadeIn">
            <h5 class="float-left mb-2">סך הכול עמודים : <span id="maxpages"></span></h5>
        </div>
        <div class="col-xl-12">
            {!! csrf_field() !!}
            <div id="notices"></div>
            <nav class="clearfix push">
                <button class="btn btn-secondary min-width-100 float-left" id="nextBTN" href="javascript:void(0)">   
                    הבא <i class="fa fa-arrow-left ml-5"></i>
                </button>
                <button class="btn btn-secondary min-width-100 float-right" id="backBTN" href="javascript:void(0)" disabled>
                    <i class="fa fa-arrow-right mr-5"></i> קודם
                </button>
                <div class="float-left">
                    <input type="text" class="form-control float-left col-8" id="current_page_input" placeholder="עמוד">
                    <p class="mt-1 mr-10">עמוד :</p>
                </div>
            </nav>
            <hr class="d-xl-none">
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
<script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@include('assets.js.student.noticeboard')
@stop
