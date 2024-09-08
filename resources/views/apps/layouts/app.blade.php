<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
      dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('apps').'/' }}" data-template="vertical-menu-template">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title') :: NEXUS | EVENT MANAGEMENT SYSTEM</title>

    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('apps/img/favicon_io/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apps/img/favicon_io//apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('apps/img/favicon_io//favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('apps/img/favicon_io//favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('apps/img/favicon_io//site.webmanifest') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Barlow%7CBarlow+Condensed:300,400,500,600,700,900">

    @include(__('apps.layouts.__css'))

    @stack(__('style'))

</head>
<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
            @include(__('apps.layouts.menu'))

            <!-- Layout container -->
            <div class="layout-page">
                @include(__('apps.layouts.navbar'))

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <div class="flex-grow-1 container-p-y container-fluid">
                    @yield('content')
                    </div>

                    @include(__('apps.layouts.footer'))
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    @include(__('apps.layouts.__js'))

    @include(__('sweetalert::alert'))

    @stack(__('script'))

</body>
</html>
