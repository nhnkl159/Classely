
<!doctype html>
<!--[if lte IE 9]>     <html lang="en" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="heb" class="no-focus"> <!--<![endif]-->
    <head>
    @include('includes.head')
    <link rel="stylesheet" id="css-main" href="{{ asset('/assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    </head>
    <body>
        <!-- Page Container -->
        <div id="page-container" class="main-content-boxed">
            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('{{ asset('/assets/img/photos/school.jpg') }}');">
                    <div class="row mx-0 bg-black-op">
                        <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                            <div class="p-30 invisible" data-toggle="appear">
                                <p class="font-size-h3 font-w600 text-white">
                                You become what you study.
                                </p>
                                <p class="font-italic text-white-op">
                                    Classely &copy; <span class="js-year-copy">2018</span>
                                </p>
                            </div>
                        </div>
                        <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible text-center" data-toggle="appear" data-class="animated fadeInRight">
                            <div class="content content-full">
                                <!-- Header -->
                                <div class="px-30 py-10">
                                    <a class="link-effect font-w700" href="index.html">
                                        <i class="fa fa-graduation-cap"></i>
                                        <span class="font-size-xl text-primary-dark">Clas</span><span class="font-size-xl">sely</span>
                                    </a>
                                    <h1 class="h3 font-w700 mt-30 mb-10">הרשמה למערכת</h1>
                                    <h2 class="h5 font-w400 text-muted mb-0">: פתיחת חשבון במערכת, אנא הכנס את פרטיך</h2>
                                </div>
                                <!-- END Header -->

                                <!-- Sign In Form -->
                                <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.js) -->
                                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-signup px-30" action="{{url('/register')}}" method="post" dir="rtl">
                                    {!! csrf_field() !!}
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="number" min="100000" class="form-control" id="signup-schoolnum" name="signup-schoolnum">
                                                <label for="signup-schoolnum">מספר בית ספר</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="text" class="form-control" id="signup-username" name="signup-username">
                                                <label for="signup-username">תעודת זהות</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="password" class="form-control" id="signup-password" name="signup-password">
                                                <label for="signup-password">סיסמה</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="password" class="form-control" id="signup-password_confirmation" name="signup-password_confirmation">
                                                <label for="signup-password_confirmation">אימות סיסמה</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signup-tos" name="signup-tos">
                                                <label class="custom-control-label" for="signup-tos">אני מסכים לתנאי השימוש</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-sm btn-hero btn-alt-primary" id="signup-btn">
                                            <i class="fa fa-plus mr-10"></i> הרשם למערכת
                                        </button>
                                        <div class="mt-30">
                                            <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="/login">
                                                <i class="fa fa-user mr-5"></i> התחבר
                                            </a>
                                            <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="/tos">
                                                <i class="fa fa-book mr-5"></i> תנאי שימוש
                                            </a>
                                        </div>
                                    </div>
                                </form>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/bootstrap.bundle.min.js"></script>
        <script src="assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="assets/js/core/jquery.appear.min.js"></script>
        <script src="assets/js/core/jquery.countTo.min.js"></script>
        <script src="assets/js/core/js.cookie.min.js"></script>
        <script src="assets/js/codebase.js"></script>

        <!-- Page JS Plugins -->
        <script src="assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="assets/js/plugins/sweetalert2/sweetalert2.min.js"></script>

        <!-- Page JS Code -->
        <script src="assets/js/pages/Auth.signuppage.js"></script>

    </body>
</html>