@extends('admin.layouts.main')

@section('title')
    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ $model->{'title_' . app()->getLocale()} }}</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('dashboard.home') }}" class="text-muted text-hover-primary">{{ __('dash.home') }}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('dashboard.' . $model->route_key . '.index') }}"
                class="text-muted text-hover-primary">{{ $model->{'title_' . app()->getLocale()} }}</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">{{ isset($data) ? __('dash.edit') : __('dash.add') }}</li>
    </ul>
@endsection

@section('content')
    <form id="form-data"
        action="{{ isset($data) ? route('dashboard.admins.update', $data) : route('dashboard.admins.store') }}"
        class="form d-flex flex-column flex-lg-row">


        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <div class="card card-flush py-4">
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('dash.main_data') }}</h2>
                    </div>
                </div>
                <div class="card-body py-0">
                    <div class="row">
                        <x-inputs.text label="{{ __('dash.name') }}" name="name" required=""
                            data="{{ isset($data) ? $data->name : '' }}" />

                        <x-inputs.text label="{{ __('dash.email') }}" name="email" required=""
                            data="{{ isset($data) ? $data->email : '' }}" />

                        <x-inputs.password label="{{ __('dash.password') }}" name="password" required="" />

                        <x-inputs.password label="{{ __('dash.password_confirmation') }}" name="password_confirmation"
                            required="" />

                        {{-- <x-inputs.select label="{{__('dash.role_id')}}" name="role_id" required="" data="{{isset($data)?$data->role_id:''}}"
                                         :list="\App\Models\Role::all()" optionValue="id" optionName="name" /> --}}
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('dashboard.' . $model->route_key . '.index') }}"
                    class="btn btn-light me-5">{{ __('dash.cancel') }}</a>
                <button type="submit" class="btn btn-primary">
                    <span class="text">{{ isset($data) ? __('dash.save changes') : __('dash.save') }}</span>
                    <span class="btn-loader d-none"><i class="fas fa-circle-notch fa-spin p-0"></i>
                        {{ __('dash.please wait') }}</span>
                </button>
            </div>

        </div>

    </form>
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
