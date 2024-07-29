@extends('admin.layouts.auth')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <div class="w-lg-400px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <h1 class="text-center mb-5">Reset Password</h1>
                    <form method="POST" action="{{ route('password.update') }}" class="w-100">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('dash.email') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" name="email"
                                required />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('dash.password') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                                required />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('dash.confirm_password') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password_confirmation" required />
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.querySelector('input[name="password"]').addEventListener('input', function() {
            const password = this.value;
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!regex.test(password)) {
                this.setCustomValidity(
                    'Password must contain at least 8 characters, including uppercase, lowercase, number and special character'
                    );
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
@endpush
