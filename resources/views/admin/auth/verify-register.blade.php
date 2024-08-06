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
                    <div class="mb-10 text-center">
                        <h1 class="text-dark mb-3">{{ __('auth.Verify_your_Email') }}</h1>
                    </div>

                    <div class="d-flex align-items-center justify-content-center flex-wrap my-12">
                        <div class="text-center">
                            <p class=" mb-2">{{ __('auth.verification_sent_to') }}
                            </p>
                            <span> {{ session('email') }}</span>
                        </div>
                    </div>
                    <div class="mt-16 mb-6 text-center">
                        <p class="text-center mb-5" style="color:#7bcbc2">{{ __('auth.verify_digit') }}</p>
                    </div>
                    <form action="{{ route('dashboard.verify.submit.otp') }}" id="verificationForm" class="w-100">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        <div class="d-flex justify-content-center mb-5"dir="ltr">
                            @for ($i = 1; $i <= 6; $i++)
                                <input type="text" name="code[]" class="form-control form-control-lg mx-1 text-center"
                                    maxlength="1" required
                                    style="width: 36px; color: #000; background-color: #fff; border: 1px solid #ccc; padding: 0.5rem;">
                            @endfor
                        </div>
                        <div class="mt-12">
                            <div id="countdown" class="text-center mb-3">
                                <p>{{ __('auth.code_will_end_after_15_min') }}</p>
                                <a id="fresh-code"
                                    href="{{ route('dashboard.fresh.code.email') }}">{{ __('auth.fresh_code') }}</a>
                            </div>
                            <button id="verifyButton" type="submit" style="background: #104a7c; color:white"
                                class="btn btn-lg  w-100 mb-5">
                                <span class="indicator-label text">{{ __('auth.check') }}</span>
                                <span class="btn-loader d-none"><i class="fas fa-circle-notch fa-spin p-0"></i>
                                    {{ __('dash.please wait') }}</span>
                            </button>
                        </div>
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
                            toastr.error('{{ __('auth.invalid_code') }}');
                        }
                        loaderEnd(form.find('button[type="submit"]'));
                    },
                    error: function(response) {
                        toastr.error('{{ __('auth.invalid_code') }}');
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
