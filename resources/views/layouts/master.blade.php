<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>MAHA 2024 | @yield('title-mini4wd')</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content name="description" />
    <meta content name="author" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/blog/vendor.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/blog/app.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fancyapps/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/boxed-check/css/boxed-check.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/powerful-pdf-viewer/css/pdfviewer.jquery.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('onpagecss')

</head>
<body>

<div class="bg-transparent">
    <div class="header-bg-image" style="background-image: url({{ asset('assets/images/maha/maha-2024-image-slice-07.png') }}); background-size: auto 100%;">
        <div class="container py-sm-4 py-3">
        </div>
    </div>
</div>

@yield('page-minicup')

<div class="bg-transparent">
    <div class="header-bg-image" style="background-image: url({{ asset('assets/images/maha/maha-2024-image-slice-07.png') }}); background-size: auto 100%;">
        <div class="container py-sm-4 py-3">
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('assets/js/blog/vendor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/blog/app.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/dist/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/fancyapps/fancybox.umd.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/jquery-validate/jquery-validate.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/powerful-pdf-viewer/js/pdfviewer.jquery.js') }}"></script>

{{--<script type="text/javascript" src="{{ asset('assets/js/demo/login-v2.demo.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('assets/js/front.js') }}"></script>--}}

@include('sweetalert::alert')

@stack('onpagescript')

{{--@production--}}
{{--    <!-- Google tag (gtag.js) -->--}}
{{--    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FL2B81V05J"></script>--}}
{{--    <script>--}}
{{--        window.dataLayer = window.dataLayer || [];--}}
{{--        function gtag(){dataLayer.push(arguments);}--}}
{{--        gtag('js', new Date());--}}

{{--        gtag('config', 'G-FL2B81V05J');--}}
{{--    </script>--}}
{{--@endproduction--}}

</body>
</html>
