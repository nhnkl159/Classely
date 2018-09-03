<!doctype html>
<!--[if lte IE 9]>         <html lang="en" class="lt-ie10 lt-ie10-msg no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="heb" class="no-focus"> <!--<![endif]-->
    <head>
        @include('includes.head')
        <link rel="stylesheet" id="css-main" href="{{ asset('/assets/css/codebase.rtl.css') }}">
    </head>
    <body>
        <div id="page-loader" class="show"></div>
        <!-- Page Container -->
        <div id="page-container" class="sidebar-o sidebar-r side-scroll page-header-modern">

            @include('includes.sidebar')

            @include('includes.header')

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content">
                    @yield('content')
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="opacity-0">
                @include('includes.footer')
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="{{ asset('/assets/js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('/assets/js/core/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/js/core/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('/assets/js/core/jquery.scrollLock.min.js') }}"></script>
        <script src="{{ asset('/assets/js/core/jquery.appear.min.js') }}"></script>
        <script src="{{ asset('/assets/js/core/jquery.countTo.min.js') }}"></script>
        <script src="{{ asset('/assets/js/core/js.cookie.min.js') }}"></script>
        <script src="{{ asset('/assets/js/codebase.js') }}"></script>
        @yield('jsfiles')
    </body>
</html>
