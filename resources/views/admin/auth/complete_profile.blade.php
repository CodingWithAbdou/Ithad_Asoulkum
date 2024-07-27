@extends('admin.layouts.auth')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <img alt="Logo" src="{{ asset('path/to/logo') }}" class="h-40px mb-10" />
            <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <form class="form w-100" method="POST" action="{{ route('dashboard.complete_profile.submit') }}">
                    @csrf
                    <div class="mb-10 text-center">
                        <h1 class="text-dark mb-3">{{ __('Complete Your Profile') }}</h1>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div class="mb-10">
                        <label class="form-label">{{ __('Name') }}</label>
                        <input class="form-control" type="text" name="name" required />
                    </div>
                    <div class="mb-10">
                        <label class="form-label">{{ __('Phone Number') }}</label>
                        <input class="form-control" type="text" name="phone" required />
                    </div>
                    <div class="mb-10">
                        <label class="form-label">{{ __('Job Title') }}</label>
                        <input class="form-control" type="text" name="job_title" required />
                    </div>
                    <div class="mb-10">
                        <label class="form-label">{{ __('Company or Office') }}</label>
                        <input class="form-control" type="text" name="company" required />
                    </div>
                    <div class="mb-10">
                        <label class="form-label">{{ __('VAT Document Number') }}</label>
                        <input class="form-control" type="text" name="vat_number" required />
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Complete Profile') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
