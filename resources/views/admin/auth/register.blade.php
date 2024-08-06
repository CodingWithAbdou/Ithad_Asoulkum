@extends('admin.layouts.auth')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <a href="{{ route('home') }}">
                    <img alt="Logo"
                        src="{{ asset(asset(\App\Models\Setting::where('setting_key', 'logo')->first()->setting_value)) }}"
                        class="h-40px mb-10" />
                </a>
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <form id="form-register" class="form w-100" method="POST"
                        action="{{ route('dashboard.register.submit') }}">
                        @csrf
                        <div class="mb-10 text-center">
                            <h1 class="text-dark mb-3">{{ __('dash.Create_an_Account') }}</h1>
                        </div>

                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('dash.email') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" name="email" />
                        </div>
                        <div class="mb-10 fv-row" data-kt-password-meter="true">
                            <div class="mb-1">
                                <label class="form-label fw-bolder text-dark fs-6">{{ __('dash.password') }}</label>
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        name="password" />
                                </div>
                            </div>
                        </div>
                        <div class="fv-row mb-10">
                            <label
                                class="form-label fw-bolder text-dark fs-6">{{ __('dash.password_confirmation') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password_confirmation" />
                        </div>
                        <div class="text-center">
                            <button type="submit" style="background: #104a7c; color:white" class="btn btn-lg  w-100 mb-5">
                                <span class="indicator-label text">{{ __('front.submit') }}</span>
                                <span class="btn-loader d-none"><i class="fas fa-circle-notch fa-spin p-0"></i>
                                    {{ __('dash.please wait') }}</span>
                            </button>

                        </div>
                    </form>
                    <div class="text-center mt-5">
                        <p>{{ __('dash.have_account1') }} <a
                                href="{{ route('dashboard.login.index') }}">{{ __('dash.create_account1') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <x-js.form />
    <script>
        $(document).on('submit', '#form-register', function(e) {
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
