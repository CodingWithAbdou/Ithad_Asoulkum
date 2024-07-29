@extends('admin.layouts.auth')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <div class="w-lg-400px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <h1 class="text-center mb-5">Reset Password</h1>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.update') }}" class="w-100">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        <div class="d-flex justify-content-center mb-5">
                            @for ($i = 0; $i < 6; $i++)
                                <input type="text" name="code[]" class="form-control form-control-lg mx-1 text-center"
                                    maxlength="1" required
                                    style="width: 40px; color: #000; background-color: #fff; border: 1px solid #ccc; padding: 0.5rem;">
                            @endfor
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">New Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                                required />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Confirm Password</label>
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
