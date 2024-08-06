<!DOCTYPE html>
@if (app()->getLocale() == 'ar')
    <html lang="en" dir="rtl" direction="rtl">
@else
    <html lang="ar">
@endif

@include('admin.layouts.head')

<body id="kt_body" class="bg-body">

    @yield('content')

    <script src="{{ asset('dashboard_assets/plugins/global/plugins.bundle.js') }}"></script>

    @stack('script')
</body>

</html>
