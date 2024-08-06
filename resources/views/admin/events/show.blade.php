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

    </ul>
@endsection

@section('content')
    <div class=" container ">
        <div class="card card-custom">
            <div class="card-body p-0">
                <!--begin::Invoice-->
                <div class="row justify-content-center pt-8 px-8 pt-md-27 px-md-0">
                    <div class="col-md-10">
                        <!-- begin: Invoice header-->
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row ">
                            <h1 class="display-6 font-weight-boldest mb-10">{{ __('dash.show_event') }} :</br>
                                <span style="color:#7bcbc2">{{ $obj->{'title_' . app()->getLocale()} }}</span>

                            </h1>
                            <div class="d-flex flex-column align-items-md-end px-0">

                                <span
                                    class="d-flex flex-column align-items-md-start font-size-h5 font-weight-bold text-muted">
                                    <div class="font-weight-bold text-dark-50 font-size-sm py-4">
                                        {{ __('dash.date_start') }} ,
                                        <span class="" style="color:#104a7c">
                                            {{ $obj->date_start }}</span>
                                    </div>
                                    <!--end::Text-->
                                    <!--begin::Text-->
                                    <div class="font-weight-bold text-dark-50 font-size-sm pb-7">
                                        {{ __('dash.date_end') }} ,
                                        <span style="color:#104a7c"> {{ $obj->date_end }}</span>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="rounded-xl overflow-hidden w-100 max-h-md-250px mb-30">
                            <div class="row shadow-lg align-items-center justify-content-center">
                                @forelse($obj->images as $image)
                                    <a href="{{ asset($image->path) }}" data-fancybox="gallery">
                                        <img src="{{ asset($image->path) }}" style="min-height: 300px"
                                            class="img-fluid {{ $loop->first ? '' : 'd-none' }}" alt="">
                                    </a>
                                @empty
                                    <img src="{{ $obj->images()->first() ? asset($obj->images()->first()->path) : asset('dashboard_assets/media/empty.jpeg') }}"
                                        style="min-height: 300px" class="w-100" alt="">
                                @endforelse
                            </div>
                        </div>
                        <!--end: Invoice header-->

                        <!--begin: Invoice body-->
                        <div class="row border-bottom pb-10">
                            <div class="col-md-9 py-md-10 pr-md-10">
                                <div class="table-responsive">
                                    <table class="table ">
                                        <tbody>
                                            <tr>
                                                <td
                                                    class="pt-1 pb-9 pl-0 font-weight-bolder text-muted font-size-lg text-uppercase">
                                                    {{ __('dash.title') }}
                                                </td>
                                                <td>{{ $obj->{'title_' . getLocale()} }}</td>
                                            </tr>
                                            <tr class="font-weight-bolder font-size-lg">
                                                <td
                                                    class="pt-1 pb-9 pl-0 font-weight-bolder text-muted font-size-lg text-uppercase">
                                                    {{ __('dash.type') }}
                                                </td>
                                                <td>{{ $obj->{'type_' . getLocale()} }}</td>
                                            </tr>
                                            <tr class="font-weight-bolder font-size-lg">
                                                <td
                                                    class="pt-1 pb-9 pl-0 font-weight-bolder text-muted font-size-lg text-uppercase">
                                                    {{ __('dash.place') }}
                                                </td>
                                                <td>{{ $obj->{'place_' . getLocale()} }}</td>
                                            </tr>
                                            <tr class="font-weight-bolder font-size-lg">
                                                <td
                                                    class="pt-1 pb-9 pl-0 font-weight-bolder text-muted font-size-lg text-uppercase">
                                                    {{ __('dash.organizer') }}
                                                </td>
                                                <td>{{ $obj->{'organizer_' . getLocale()} }}</td>
                                            </tr>
                                            <tr class="font-weight-bolder font-size-lg">
                                                <td
                                                    class="pt-1 pb-9 pl-0 font-weight-bolder text-muted font-size-lg text-uppercase">
                                                    {{ __('dash.phone') }}
                                                </td>
                                                <td>{{ $obj->{'phone'} }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="border-bottom w-100 mt-7 mb-13"></div>
                            </div>

                        </div>
                        <!--end: Invoice body-->
                    </div>
                </div>
                <!-- begin: Invoice action-->

                <!--end::Invoice-->
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endpush
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <script>
        Fancybox.bind("[data-fancybox]", {});
    </script>
@endpush
