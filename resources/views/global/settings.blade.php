@extends('layouts.master') 

@section('cssfiles')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/js/plugins/datetimepicker/jquery.datetimepicker.min.css') }}">
@stop

@section('content')


<div class="my-50 text-center">
    <h2 class="font-w700 text-black mb-10">הגדרות משתמש</h2>
</div>
<div class="block block-fx-shadow">
        <div class="block-content">
            <form action="{{action('UsersController@updatesettings')}}" method="post">
            {!! csrf_field() !!}
                <h2 class="content-heading text-black">הגדרות פרופיל</h2>
                <div class="form-group row">
                    <div class="col-12">
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <h2 class="text-center text-danger"> {{ $error }} </h2>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="row items-push">
                    <div class="col-lg-3">
                        <p class="text-muted">
                            כאן ניתן לשנות את הגדרות החשבון והגישה לחשבון, כדי להשתמש במערכת חובה להכניס כתובת דואר אלקטרוני.
                        </p>
                    </div>
                    <div class="col-lg-7 offset-lg-1">
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="settings-nickname">תעודת זהות</label>
                                <input type="text" class="form-control form-control-lg" id="settings-nickname" name="settings-nickname" value="{{ Auth::user()->username }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="settings-email">דואר אלקטרוני</label> <span class="text-danger">(*)</span>
                                <input type="email" class="form-control form-control-lg" id="settings-email" name="settings-email" placeholder="הכנס כתובת דואר אלקטרוני..." value="{{ Auth::user()->email }}">
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" class="btn btn-alt-primary" id="settings-email-btn">עדכן הגדרות</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form action="{{action('UsersController@updatesettings')}}" method="post">
            {!! csrf_field() !!}
                <h2 class="content-heading text-black">פרטים אישיים</h2>
                <div class="row items-push">
                    <div class="col-lg-3">
                        <p class="text-muted">
                            ניהול הגדרות החשיפה והנתונים שבהם אנחנו משתמשים כדי להתאים אישית את החוויה שלך.
                        </p>
                    </div>
                    <div class="col-lg-7 offset-lg-1">
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="settings-firstname">שם פרטי</label> <span class="text-danger">(*)</span>
                                <input type="text" class="form-control form-control-lg" id="settings-firstname" name="settings-firstname" value="{{$current_user_details['firstName']}}">

                            </div>
                            <div class="col-6">
                                <label for="settings-lastname">שם משפחה</label> <span class="text-danger">(*)</span>
                                <input type="text" class="form-control form-control-lg" id="settings-lastname" name="settings-lastname" value="{{$current_user_details['lastName']}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="settings-address">רחוב ומספר בית</label> <span class="text-danger">(*)</span>
                                <input type="text" class="form-control form-control-lg" id="settings-address" name="settings-address" value="{{$current_user_details['address']}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="settings-city">עיר</label> <span class="text-danger">(*)</span>
                                <input type="text" class="form-control form-control-lg" id="settings-city" name="settings-city" value="{{$current_user_details['city']}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="settings-zipcode">מיקוד</label> <span class="text-danger">(*)</span>
                                <input type="text" class="form-control form-control-lg" id="settings-zipcode" name="settings-zipcode" value="{{$current_user_details['zipcode']}}">
                            </div>
                            <div class="col-6">
                                <label for="settings-phone">מין</label> <span class="text-danger">(*)</span>
                                <select class="form-control" id="settings-gender" name="settings-gender">
                                    <option value="0" {{ $current_user_details['gender'] == 0 ? 'selected' : ''}}>זכר</option>
                                    <option value="1" {{ $current_user_details['gender'] == 1 ? 'selected' : ''}}>נקבה</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <label for="settings-postal">תאריך לידה</label> <span class="text-danger">(*)</span>
                                <input type="text" class="js-datepicker form-control form-control-lg js-datepicker-enabled" id="settings-dateOfBirth" name="settings-dateOfBirth" value="{{$current_user_details['dateOfBirth']}}" autocomplete="off">
                            </div>
                            <div class="col-6">
                                <label for="settings-phone">מספר פאלפון</label> <span class="text-danger">(*)</span>
                                <input type="text" class="form-control form-control-lg" id="settings-phone" name="settings-phone" value="{{$current_user_details['phoneNumber']}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" class="btn btn-alt-primary" id="settings-data-btn">עדכן פרטים</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form action="be_pages_crypto_settings.php" method="post" onsubmit="return false;">
            {!! csrf_field() !!}
                <h2 class="content-heading text-black">שינוי סיסמה</h2>
                <div class="row items-push">
                    <div class="col-lg-3">
                        <p class="text-muted">
                            שינוי סיסמת הכניסה שלך היא דרך קלה לשמור על אבטחת החשבון שלך.
                        </p>
                    </div>
                    <div class="col-lg-7 offset-lg-1">
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="settings-password">סיסמה נוכחית</label>
                                <input type="password" class="form-control form-control-lg" id="settings-password" name="settings-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="settings-password-new">סיסמה חדשה</label>
                                <input type="password" class="form-control form-control-lg" id="settings-password-new" name="settings-password-new">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="settings-password-new-confirm">אימות סיסמה חדשה</label>
                                <input type="password" class="form-control form-control-lg" id="settings-password-new-confirm" name="settings-password-new-confirm">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" class="btn btn-alt-primary" id="settings-password-btn">עדכן סיסמה</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop


@section('jsfiles')
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.he.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&region=il&sensor=false&language=iw" type="text/javascript"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
@include('assets.js.global.settings')
@stop