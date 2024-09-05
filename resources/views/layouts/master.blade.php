<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>MINI 4WD MHX CUP 2023 | @yield('title-mini4wd')</title>
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
    <div class="header-bg-image" {{--style="background-image: url({{ asset('assets/images/mini-4wd/finish-flag@4x.png') }});"--}}>
        <div class="container p-sm-5 px-3 pt-3 pb-5">
            <div class="col-md-6 mx-auto">
                <a href="{{--{{ route('mhxcup.welcome') }}--}}">
                    <img src="{{ asset('assets/images/matec-01.png') }}" alt="" class="img-fluid d-block mx-auto">
                </a>
            </div>
        </div>
    </div>
</div>

@yield('page-minicup')

<div class="bg-black pt-sm-0 pt-5 pb-sm-0 pb-5">
    <div class="container p-sm-5">
        <div class="row g-5 align-items-center justify-content-center">
            <div class="col-md-8">
                <img src="{{ asset('assets/images/mini-4wd/footer-celebrate@4x.png') }}" alt="" class="img-fluid">
            </div>
            {{--<div class="col-md-2">
                <img src="{{ asset('assets/images/mini-4wd/organized-by@4x.png') }}" alt="" class="d-block mx-auto h-50px">
            </div>
            <div class="col-md-2">
                <img src="{{ asset('assets/images/mini-4wd/supported-by@4x.png') }}" alt="" class="d-block mx-auto h-50px">
            </div>--}}
        </div>

        <h6 class="mt-5 mb-0 text-center text-white">
            &copy; Copyright of Fita Hobby Shop {{ date('Y') }} <br/>
            Powered and designed by <a class="text-white" href="#">Ardia Nexus Sdn. Bhd.</a>
        </h6>
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

{{--@include('sweetalert::alert')--}}

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
