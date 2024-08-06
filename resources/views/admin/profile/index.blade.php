@extends('admin.layouts.main')

@section('title')
    <!--begin::Page title-->
    <div class="page-title d-flex flex-column me-3">
        <!--begin::Title-->
        <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ __('dash.home') }}</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
            <li class="breadcrumb-item text-gray-600">
                <a href="{{ route('dashboard.home') }}" class="text-gray-600 text-hover-primary">{{ __('dash.home') }}</a>
            </li>
            <li class="breadcrumb-item text-gray-600">{{ __('dash.profile') }}</li>

        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <!--begin::Actions-->
    <div class="d-flex align-items-center py-2 py-md-1"></div>
    <!--end::Actions-->
@endsection

@section('content')
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex align-items-center flex-wrap flex-sm-nowrap mb-3">

                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="javascript:void(0)"
                                    class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $user->name }}</a>
                            </div>
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="javascript:void(0)"
                                    class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                fill="black" />
                                            <path
                                                d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                fill="black" />
                                        </svg>
                                    </span> {{ $user->role_id == 1 ? __('dash.admin') : __('dash.agent') }}
                                </a>
                                <a href="javascript:void(0)"
                                    class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                fill="black" />
                                            <path
                                                d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                fill="black" />
                                        </svg>
                                    </span> {{ $user->email }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('dash.profile') }}</h3>
            </div>
        </div>
        <div id="kt_account_settings_profile_details" class="collapse show">
            <form id="form-data" class="form" action="{{ route('dashboard.profile.update') }}"
                enctype="multipart/form-data">
                <div class="card-body border-top p-9">
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('dash.name') }}</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="name" class="form-control form-control-lg form-control-solid"
                                value="{{ $user->name }}" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('dash.email') }}</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="email" class="form-control form-control-lg form-control-solid"
                                value="{{ $user->email }}" disabled />
                        </div>
                    </div>
                    @agent
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('dash.phone') }}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="phone_number"
                                    class="form-control form-control-lg form-control-solid"
                                    value="{{ $user->phone_number }}" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('dash.job_title') }}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="job_title" class="form-control form-control-lg form-control-solid"
                                    value="{{ $user->job_title }}" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('dash.company') }}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="company" class="form-control form-control-lg form-control-solid"
                                    value="{{ $user->company }}" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('dash.id_number') }}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="id_number" class="form-control form-control-lg form-control-solid"
                                    value="{{ $user->id_number }}" />
                            </div>
                        </div>
                    @endagent
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('dashboard.home') }}" type="reset"
                        class="btn btn-light btn-active-light-primary me-2">{{ __('dash.discard') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('dash.save changes') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <x-js.form />
    <script>
        $(document).on('submit', '#form-data', function(e) {
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
                    if (response.status) {
                        SwalModal(response.msg, 'success', response.url);
                    } else {
                        SwalModal(response.msg, 'error');
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
    </script>
@endpush
