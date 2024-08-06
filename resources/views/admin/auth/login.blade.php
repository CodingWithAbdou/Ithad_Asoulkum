<!--login.blade.php-->

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
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <form id="form-login" class="form w-100" method="POST" action="{{ route('dashboard.login.form') }}">
                        @csrf
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">{{ __('auth.sign_in') }}</h1>
                        </div>

                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('dash.email') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="email" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('dash.password') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                                autocomplete="off" />
                        </div>
                        <div class="d-flex justify-content-between mb-10">
                            <a href="{{ route('password.request') }}"
                                class="link-primary fs-6 fw-bolder">{{ __('dash.forgot') }}</a>
                        </div>
                        <div class="text-center">

                            <button type="submit" style="background: #104a7c; color:white" class="btn btn-lg  w-100 mb-5">
                                <span class="indicator-label text">{{ __('front.login') }}</span>
                                <span class="btn-loader d-none"><i class="fas fa-circle-notch fa-spin p-0"></i>
                                    {{ __('dash.please wait') }}</span>
                            </button>

                        </div>
                    </form>
                    <div class="text-center mt-5">
                        <p>{{ __('dash.have_account') }} <a
                                href="{{ route('dashboard.register') }}">{{ __('dash.create_account') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <x-js.form />
    <script>
        $(document).on('submit', '#form-login', function(e) {
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
