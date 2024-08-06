<!DOCTYPE html>
@if (app()->getLocale() == 'ar')
    <html lang="en" dir="rtl" direction="rtl">
@else
    <html lang="ar">
@endif

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="{{ \App\Models\Setting::where('setting_key', 'keywords')->first()->setting_value }}" />
    <meta name="title"
        content="{{ \App\Models\Setting::where('setting_key', 'website_name_' . getLocale())->first()->setting_value }}" />
    <meta name="description"
        content="{{ \App\Models\Setting::where('setting_key', 'description_' . getLocale())->first()->setting_value }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon"
        href="{{ asset(\App\Models\Setting::where('setting_key', 'favicon')->first()->setting_value) }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <link href="{{ asset('assets/lib/aos.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/lib/nice-select.css') }}" />
    @vite('resources/css/app.css')

    <title>{{ \App\Models\Setting::where('setting_key', 'website_name_' . getLocale())->first()->setting_value }}
    </title>
    <style>
        @font-face {
            font-family: "Dinar";
            src: url({{ asset('assets/font/GE-Dinar-One-Medium.otf') }});
        }

        @if (getLocale() == 'ar')

            body {
                font-family: Dinar, sans-serif;
            }

        @else

            body {
                font-family: "Cairo", sans-serif;
            }
        @endif
    </style>
</head>

<body class="scroll-smooth overflow-x-hidden {{ app()->getLocale() == 'ar' ? 'ar' : 'en' }}">
    @include('front.layouts.header')

    <!--------------
        Main Content
    --------------->
    <main class="py-32 relative min-h-[800px] overflow-hidden">

        @include('front.layouts.nav_md')
        @yield('content')
    </main>

    <!--------------
        Footer
    --------------->
    @include('front.layouts.footer')

</body>
<script src="{{ asset('assets/lib/jquery.js') }}"></script>
<script src="{{ asset('assets/lib/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/lib/aos.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@vite('resources/js/app.js')
@stack('script')

<script>
    const SwalModal = (text, type, url) => {
        Swal.fire({
            text: text,
            icon: type,
            confirmButtonText: '{{ __('front.Ok got it') }}',
            confirmButtonColor: '#7bcbc2',
            customClass: {
                title: "Nexa-Thin",
                content: 'Nexa-Thin',
                confirmButton: 'Nexa-Thin',
            }
        }).then(function() {
            if (url)
                window.location = url;
        });
    };
</script>

</html>
