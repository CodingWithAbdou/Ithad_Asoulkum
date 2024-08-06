<head>
    <title>{{ \App\Models\Setting::where('setting_key', 'website_name_' . getLocale())->first()->setting_value }}
    </title>

    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="shortcut icon"
        href="{{ asset(\App\Models\Setting::where('setting_key', 'favicon')->first()->setting_value) }}" />

    @if (app()->getLocale() == 'ar')
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo:300,400,500,600,700" />
        <!--end::Fonts-->
        <link href="{{ asset('dashboard_assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet"
            type="text/css" />
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{ asset('dashboard_assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('dashboard_assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
    @else
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <link href="{{ asset('dashboard_assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
            type="text/css" />
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{ asset('dashboard_assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('dashboard_assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
    @endif

    <!--begin::Custom Style-->
    <link href="{{ asset('dashboard_assets/css/style.css?v=1.0') }}" rel="stylesheet" type="text/css" />
    <!--end::Custom Style-->

    <style>
        @font-face {
            font-family: "Dinar";
            src: url({{ asset('assets/font/GE-Dinar-One-Medium.otf') }});
        }

        @if (getLocale() == 'ar')

            body {
                font-family: Dinar, sans-serif !important;
            }
        @endif
    </style>
    @stack('style')
</head>
