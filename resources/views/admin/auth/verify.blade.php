@extends('admin.layouts.auth')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <h1 class="mb-5">Verify Your Email</h1>
                <p class="mb-5">Enter the 6-digit code sent to your email</p>
                <form method="POST" action="{{ route('dashboard.verify.submit') }}" class="w-100">
                    @csrf
                    <div class="d-flex justify-content-between mb-5">
                        @for ($i = 1; $i <= 6; $i++)
                            <input type="text" name="code[]" class="form-control form-control-lg mx-1 text-center"
                                maxlength="1" style="width: 50px;" required>
                        @endfor
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Verify</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[name="code[]"]');
            inputs.forEach((input, index) => {
                input.addEventListener('input', function() {
                    if (this.value.length === this.maxLength) {
                        if (index < inputs.length - 1) inputs[index + 1].focus();
                    }
                });
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && !this.value) {
                        if (index > 0) inputs[index - 1].focus();
                    }
                });
            });
        });
    </script>
@endpush
