<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="generator" content="Bootply"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/aksata.css') }}" rel="stylesheet">

    <!-- Page-Specific Stylesheets -->
    @yield('stylesheet')

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <title>{{ $title or 'Aksata' }}</title>
</head>

<body>
<div class="wrapper">
    @include('app.navbar')

    <div class="container">
        <div class="row">

            <div class="col-md-2">
                @include('app.left_sidebar')
            </div>

            <div class="col-md-8">
                @yield('content')
            </div>

            <div class="col-md-2">
                @include('app.right_sidebar')
            </div>

        </div>
    </div>

    <div class="footer_push"></div>
</div>

@include('app.footer')

<!-- Scripts -->
<script src="{{ asset('/assets/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>

<!-- Page-Specific Scripts -->
@yield('script')
</body>

</html>
