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
                    <h1 class="text-center mb-10">{{ __('auth.complete_your_profile') }}</h1>
                    <form method="POST" id="form-complete-profile" action="{{ route('dashboard.profile.complete.submit') }}"
                        class="w-100">
                        @csrf
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('dash.name') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name" />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('auth.number_phone') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="phone_number" />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('auth.job_title') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="job_title" />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('auth.company_or_office') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="company" />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('auth.fal_file') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="id_number" />
                        </div>
                        <div class="mb-10 form-check form-check-custom form-check-solid">
                            <input class="form-check-input" name="agree" checked type="checkbox" value="1"
                                id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ __('auth.agree_on_') }} <a target="__blanck"
                                    href="{{ route('about.index') . '#terms' }}">
                                    <span style="coloor:#104a7c;">{{ __('auth.terms') }}</span> </a>
                            </label>
                        </div>
                        <button id="verifyButton" type="submit" style="background: #104a7c; color:white"
                            class="btn btn-lg  w-100 mb-5">
                            <span class="indicator-label text">{{ __('auth.send_password_OTP') }}</span>
                            <span class="btn-loader d-none"><i class="fas fa-circle-notch fa-spin p-0"></i>
                                {{ __('dash.please wait') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <x-js.form />
    <script>
        $(document).on('submit', '#form-complete-profile', function(e) {
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
