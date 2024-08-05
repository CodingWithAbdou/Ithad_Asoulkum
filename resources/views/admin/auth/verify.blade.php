@extends('admin.layouts.auth')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <div class="w-lg-400px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <h1 class="text-center mb-5">{{ __('auth.Verify_your_Email') }}</h1>
                    <p class="text-center mb-5">{{ __('auth.verify_digit') }}</p>
                    <p class="text-center mb-5">{{ __('auth.verification_sent_to', ['email' => session('email')]) }}</p>
                    <div id="countdown" class="text-center mb-3"></div>
                    <form id="verificationForm" class="w-100">

                        @csrf
                        <input type="hidden" name="email" value="{{ session('email') }}">

                        <div class="d-flex justify-content-center mb-5">
                            @for ($i = 1; $i <= 6; $i++)
                                <input type="text" name="code[]" class="form-control form-control-lg mx-1 text-center"
                                    maxlength="1" required
                                    style="width: 40px; color: #000; background-color: #fff; border: 1px solid #ccc; padding: 0.5rem;">
                            @endfor
                        </div>
                        <button type="button" id="verifyButton" class="btn btn-primary w-100"
                            style="opacity: 1;">{{ __('auth.check') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[name="code[]"]');
            const form = document.getElementById('verificationForm');
            const verifyButton = document.getElementById('verifyButton');

            const expireTime = new Date(
                '{{ \Carbon\Carbon::now()->addMinutes(15) }}'); // Adjust expiration time accordingly
            const countdownElement = document.getElementById('countdown');

            const updateCountdown = () => {
                const now = new Date().getTime();
                const distance = expireTime - now;

                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownElement.innerHTML = `Code expires in: ${minutes}m ${seconds}s`;

                if (distance < 0) {
                    clearInterval(countdownInterval);
                    countdownElement.innerHTML = "Code has expired";
                    verifyButton.disabled = true;
                }
            };

            const countdownInterval = setInterval(updateCountdown, 1000);
            updateCountdown();

            inputs.forEach((input, index) => {
                input.addEventListener('input', function() {
                    if (this.value.length === this.maxLength) {
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        } else {
                            verifyButton.style.opacity = '0.5';
                            setTimeout(() => {
                                submitForm();
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

            const submitForm = () => {
                const formData = new FormData(form);

                fetch("{{ route('dashboard.verify.submit.otp') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success('Verification successful!');
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 2000);
                        } else {
                            toastr.error(data.message);
                            verifyButton.style.opacity = '1';
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                        toastr.error('An error occurred while verifying the code.');
                        verifyButton.style.opacity = '1';
                    });
            };

            verifyButton.addEventListener('click', submitForm);
        });
    </script>
@endpush
