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
        action="{{ isset($data) ? route('dashboard.' . $model->route_key . '.update', $data) : route('dashboard.' . $model->route_key . '.store') }}"
        class="form d-flex flex-column flex-lg-row">

        {{-- <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px min-w-lg-300px mb-7 me-lg-10">
            <x-inputs.image label="{{ __('dash.image') }}" name="image" required=""
                data="{{ isset($data) ? $data->image : '' }}" />
        </div> --}}

        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <div class="card card-flush py-4">
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('dash.main_data') }}</h2>
                    </div>
                </div>
                <div class="card-body py-0">
                    <div class="row">
                        @if (isset($data))
                            <x-inputs.select label="{{ __('dash.status') }}" name="is_active" required=""
                                data="{{ isset($data) ? $data->is_active : '' }}" :list="$array" optionValue="value"
                                optionName="name" />
                        @else
                            <x-inputs.select label="{{ __('dash.type') }}" name="type" required=""
                                data="{{ isset($data) ? $data->type : '' }}" :list="\App\Models\Type::all()" optionValue="key"
                                optionName="{{ 'name_' . getLocale() }}" />

                            <x-inputs.select label="{{ __('dash.category') }}" name="category" required=""
                                data="{{ isset($data) ? $data->category : '' }}" :list="\App\Models\Category::all()" optionValue="key"
                                optionName="{{ 'name_' . getLocale() }}" />

                            <x-inputs.number label="{{ __('dash.price') }}" name="price" required=""
                                data="{{ isset($data) ? $data->price : '' }}" />
                            <x-inputs.select label="{{ __('dash.currency') }}" name="currency" required=""
                                data="{{ isset($data) ? $data->currency : '' }}" :list="$currency" optionValue="value"
                                optionName="name" />

                            <x-inputs.text label="{{ __('dash.area') }}" name="area" required=""
                                data="{{ isset($data) ? $data->area : '' }}" />

                            <x-inputs.text label="{{ __('dash.city') . ' Ar' }}" name="city_ar" required=""
                                data="{{ isset($data) ? $data->city_ar : '' }}" />
                            <x-inputs.text label="{{ __('dash.city') . ' En' }}" name="city_en" required=""
                                data="{{ isset($data) ? $data->city_en : '' }}" />

                            <x-inputs.text label="{{ __('dash.neighborhood') . ' Ar' }}" name="neighborhood_ar"
                                required="" data="{{ isset($data) ? $data->neighborhood_ar : '' }}" />
                            <x-inputs.text label="{{ __('dash.neighborhood') . ' En' }}" name="neighborhood_en"
                                required="" data="{{ isset($data) ? $data->neighborhood_en : '' }}" />

                            <x-inputs.text label="{{ __('dash.place') . ' Ar' }}" name="place_ar" required=""
                                data="{{ isset($data) ? $data->place_ar : '' }}" />
                            <x-inputs.text label="{{ __('dash.place') . ' En' }}" name="place_en" required=""
                                data="{{ isset($data) ? $data->place_en : '' }}" />

                            <x-inputs.textarea label="{{ __('dash.description') . ' Ar' }}" name="description_ar"
                                required="" data="{{ isset($data) ? $data->description_ar : '' }}" />
                            <x-inputs.textarea label="{{ __('dash.description') . ' En' }}" name="description_en"
                                required="" data="{{ isset($data) ? $data->description_en : '' }}" />


                            <label class="form-label" for="">صور العرض</label>
                            <input class="custom-file-input" accept=".png, .svg, .jpg, .jpeg, .webp" type="file"
                                name="images[]" multiple>
                        @endif
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

@push('style')
    <style>
        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }

        .custom-file-input::before {
            content: '{{ __('dash.choose file') }}';
            display: inline-block;
            background: linear-gradient(top, #f9f9f9, #e3e3e3);
            border: 1px solid #999;
            border-radius: 3px;
            padding: 5px 8px;
            outline: none;
            white-space: nowrap;
            -webkit-user-select: none;
            cursor: pointer;
            text-shadow: 1px 1px #fff;
            font-weight: 700;
            font-size: 10pt;
        }

        .custom-file-input:hover::before {
            border-color: black;
        }

        .custom-file-input:active::before {
            background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
        }
    </style>
@endpush

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
