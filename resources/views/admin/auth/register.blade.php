
@extends('admin.layouts.auth')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <img alt="Logo"
                    src="{{ asset(asset(\App\Models\Setting::where('setting_key', 'logo')->first()->setting_value)) }}"
                    class="h-40px mb-10" />
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <form class="form w-100" method="POST" action="{{ route('dashboard.register.submit') }}">
                        @csrf
                        <div class="mb-10 text-center">
                            <h1 class="text-dark mb-3">{{ __('Create an Account') }}</h1>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <h4 class="fw-bold">{{ __('Whoops! Something went wrong.') }}</h4>
                                    @foreach ($errors->all() as $error)
                                        <span>{{ $error }}</span>
                                    @endforeach
                                </div>
                                <button type="button"
                                    class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                    data-bs-dismiss="alert">
                                    <span class="svg-icon svg-icon-2x svg-icon-danger">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                transform="rotate(45 7.41422 6)" fill="black" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        @endif
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" name="email"
                                required />
                        </div>
                        <div class="mb-10 fv-row" data-kt-password-meter="true">
                            <div class="mb-1">
                                <label class="form-label fw-bolder text-dark fs-6">{{ __('Password') }}</label>
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        name="password" required />
                                </div>
                            </div>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fw-bolder text-dark fs-6">{{ __('Confirm Password') }}</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password_confirmation" required />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">{{ __('Submit') }}</span>
                                <span class="indicator-progress">{{ __('Please wait...') }}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-5">
                        <p>{{ __('Already have an account?') }} <a
                                href="{{ route('dashboard.login.index') }}">{{ __('Sign In') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('dashboard_assets/js/custom/authentication/sign-up/general.js') }}"></script>
@endpush
