<!DOCTYPE html>
<html lang="en">

<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/line-awesome/css/line-awesome.min.css') }}">
    <!--<link rel="stylesheet" type="text/css" href="assets/fonts/open-sans/styles.css">-->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/montserrat/styles.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('libs/tether/css/tether.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/jscrollpane/jquery.jscrollpane.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/common.min.css') }}">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/themes/primary.min.css') }}">
    <link class="ks-sidebar-dark-style" rel="stylesheet" type="text/css"
          href="{{ asset('assets/styles/themes/sidebar-black.min.css') }}">
    <!-- END THEME STYLES -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/kosmo/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/noty/noty.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/widgets/panels.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/dashboard/tabbed-sidebar.min.css') }}">
    @yield('head')
</head>
<!-- END HEAD -->

<body class="ks-navbar-fixed ks-sidebar-default ks-sidebar-position-fixed ks-page-header-fixed ks-theme-primary ks-page-loading">
<!-- remove ks-page-header-fixed to unfix header -->

<!-- BEGIN HEADER -->
<nav class="navbar ks-navbar">
    <!-- BEGIN HEADER INNER -->
    <!-- BEGIN LOGO -->
    <div href="/" class="navbar-brand">
        <!-- BEGIN RESPONSIVE SIDEBAR TOGGLER -->
        <a href="#" class="ks-sidebar-toggle"><i class="ks-icon la la-bars" aria-hidden="true"></i></a>
        <a href="#" class="ks-sidebar-mobile-toggle"><i class="ks-icon la la-bars" aria-hidden="true"></i></a>
        <!-- END RESPONSIVE SIDEBAR TOGGLER -->

        <div class="ks-navbar-logo">
            <a href="/" class="ks-logo">{{ env('APP_NAME') }}</a>
        </div>
    </div>
    <!-- END LOGO -->

    <!-- BEGIN MENUS -->
    <div class="ks-wrapper">
        <nav class="nav navbar-nav">
            <!-- BEGIN NAVBAR MENU -->
            <div class="ks-navbar-menu">

            </div>
            <!-- END NAVBAR MENU -->

            <!-- BEGIN NAVBAR ACTIONS -->
            <div class="ks-navbar-actions">

            @auth
                @include('layouts.navbar.actions')
            @endauth

            <!-- END NAVBAR USER -->
            </div>
            <!-- END NAVBAR ACTIONS -->
        </nav>

        <!-- BEGIN NAVBAR ACTIONS TOGGLER -->
        <nav class="nav navbar-nav ks-navbar-actions-toggle">
            <a class="nav-item nav-link" href="#">
                <span class="la la-ellipsis-h ks-icon ks-open"></span>
                <span class="la la-close ks-icon ks-close"></span>
            </a>
        </nav>
        <!-- END NAVBAR ACTIONS TOGGLER -->
    </div>
    <!-- END MENUS -->
    <!-- END HEADER INNER -->
</nav>
<!-- END HEADER -->


<div class="ks-page-container ks-dashboard-tabbed-sidebar-fixed-tabs">
@auth
    <!-- BEGIN DEFAULT SIDEBAR -->
       <!--  <div class="ks-column ks-sidebar ks-info">
            <div class="ks-wrapper ks-sidebar-wrapper">
                @include('layouts.navbar.sidebar')
            </div>
        </div> -->
@endauth
<!-- END DEFAULT SIDEBAR -->
    <div class="ks-column ks-page">
        <div class="ks-page-content">
            @yield('content')
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('libs/responsejs/response.min.js') }}"></script>
<script src="{{ asset('libs/loading-overlay/loadingoverlay.min.js') }}"></script>
<script src="{{ asset('libs/tether/js/tether.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('libs/jscrollpane/jquery.jscrollpane.min.js') }}"></script>
<script src="{{ asset('libs/jscrollpane/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('libs/flexibility/flexibility.js') }}"></script>
<script src="{{ asset('libs/noty/noty.min.js') }}"></script>
<script src="{{ asset('libs/velocity/velocity.min.js') }}"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('assets/scripts/common.min.js') }}"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script type="application/javascript"></script>

<div class="ks-mobile-overlay"></div>
<script>
    {{--@if(Session::has('notification'))--}}
    {{--new Noty({--}}
        {{--type: '{{ Session::get('notification.alert-type') }}',--}}
        {{--layout: 'topRight',--}}
        {{--text: '{{ Session::get('notification.message') }}'--}}
    {{--}).show();--}}
    {{--@endif--}}
</script>

@yield('scripts')

</body>
</html>
