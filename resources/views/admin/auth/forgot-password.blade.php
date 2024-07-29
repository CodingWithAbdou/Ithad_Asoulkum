@extends('admin.layouts.auth')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <div class="w-lg-400px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <h1 class="text-center mb-5">Forgot Password</h1>
                    <form method="POST" action="{{ route('password.email') }}" class="w-100">
                        @csrf
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('dash.email') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" name="email"
                                required />
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>
                    </form>
                    <div class="text-center mt-5">
                        <a href="{{ route('dashboard.login.index') }}">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
