@extends('admin.layouts.auth')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <a href="{{ route('home') }}">
                    <img alt="Logo"
                        src="{{ asset(\App\Models\Setting::where('setting_key', 'logo')->first()->setting_value) }}"
                        class="h-40px mb-10" />
                </a>
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <h1 class="text-center mb-12">{{ __('auth.forgot_password') }}</h1>
                    <form method="POST" id="forgot-password" action="{{ route('password.email') }}" class="w-100">
                        @csrf
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('dash.email') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" name="email" />
                        </div>
                        <button type="submit" style="background: #104a7c; color:white" class="btn btn-lg  w-100 mb-5">
                            <span class="indicator-label text">{{ __('auth.send_password_OTP') }}</span>
                            <span class="btn-loader d-none"><i class="fas fa-circle-notch fa-spin p-0"></i>
                                {{ __('dash.please wait') }}</span>
                        </button>

                    </form>
                    <div class="text-center mt-5">
                        <a href="{{ route('dashboard.login.index') }}">{{ __('auth.back_to_login') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <x-js.form />
    <script>
        $(document).on('submit', '#forgot-password', function(e) {
            e.preventDefault();
            let form = $(this);
            loaderStart(form.find('button[type="submit"]'));
            HideValidationError(form);
            let action = $(this).attr('action');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: action,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    loaderEnd(form.find('button[type="submit"]'));
                    if (response.success) {
                        window.location = response.redirect;
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(i, value) {
                        let index = i.split('.')[0];
                        showValidationError(form, index, value);
                    });
                    loaderEnd(form.find('button[type="submit"]'));
                }
            });
        })
    </script>
@endpush
