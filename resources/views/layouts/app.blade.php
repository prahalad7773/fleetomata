<!DOCTYPE html>
<html lang="en">

<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8">
    <title>Fleetomata</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/line-awesome.min.css') }}">
    <!--<link rel="stylesheet" type="text/css" href="assets/fonts/open-sans/styles.css">-->

    <link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/tether.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.jscrollpane.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/auth.min.css') }}">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" type="text/css" href="css/primary.min.css">
    <link class="ks-sidebar-dark-style" rel="stylesheet" type="text/css"
          href="css/sidebar-black.min.css">
    <!-- END THEME STYLES -->

</head>
<!-- END HEAD -->

<body class="ks-navbar-fixed ks-sidebar-default ks-sidebar-position-fixed ks-page-header-fixed ks-theme-primary ks-page-loading">
<!-- remove ks-page-header-fixed to unfix header -->

<!-- BEGIN HEADER -->
@auth
    @include('layouts.navbar.actions')
@endauth
<!-- END HEADER -->


<div class="ks-page-container">
    <!-- BEGIN DEFAULT SIDEBAR -->
@auth
    @include('layouts.navbar.sidebar')
@endauth
<!-- END DEFAULT SIDEBAR -->
    <div class="ks-column ks-page">
        @include('layouts.formErrors')
        @yield('content')
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/response.min.js') }}"></script>
<script src="{{ asset('js/loadingoverlay.min.js') }}"></script>
<script src="{{asset('/js/tether.min.js')}}"></script>
<script src="{{asset('/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/jquery.jscrollpane.min.js')  }}"></script>
<script src="{{ asset('js/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('js/noty.min.js') }}"></script>
<script src="{{ asset('js/velocity.min.js') }}"></script>
<script src="{{ asset('js/flexibility.js') }}"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('js/common.min.js') }}"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<div class="ks-mobile-overlay"></div>

</body>
</html>