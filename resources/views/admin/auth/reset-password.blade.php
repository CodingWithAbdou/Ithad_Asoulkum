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
                    <h1 class="text-center mb-5">{{ __('auth.reset_password') }}</h1>
                    <form method="POST" id="verificationForm" action="{{ route('password.update') }}" class="w-100">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('auth.new_password') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password" />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('auth.confirm_password') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password_confirmation" />
                        </div>
                        <button type="submit" style="background: #104a7c; color:white" class="btn btn-lg  w-100 mb-5">
                            <span class="indicator-label text">{{ __('auth.fresh') }}</span>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <x-js.form />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[name="code[]"]');
            const form = document.getElementById('verificationForm');
            inputs.forEach((input, index) => {
                input.addEventListener('input', function() {
                    if (this.value.length === this.maxLength) {
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        } else {
                            setTimeout(() => {
                                verifyButton.click();
                            }, 300);
                        }
                    }
                });
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && !this.value) {
                        if (index > 0) inputs[index - 1].focus();
                    }
                });
            });

            $(document).on('submit', '#verificationForm', function(e) {
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
                        if (response.success) {
                            toastr.success('{{ __('auth.verified_successfully') }}');
                            window.location.href = response.redirect;
                        } else {
                            toastr.error('{{ __('auth.invalid_email') }}');
                        }
                        loaderEnd(form.find('button[type="submit"]'));
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

            $('#fresh-code').on('click', function(e) {
                e.preventDefault();
                let action = $(this).attr('href');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: action,
                    success: function(response) {
                        toastr.success('{{ __('auth.fresh_code_sent') }}');
                    },
                    error: function(response) {
                        toastr.error('{{ __('auth.error') }}');
                    }
                });
            })
        });
    </script>
@endpush
