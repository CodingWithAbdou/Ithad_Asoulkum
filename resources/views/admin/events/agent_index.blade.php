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
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('dash.events') }}</h2>
                </div>
            </div>
            <div class="card-body pt-12">
                <div class="row">
                    @foreach ($data as $record)
                        <div class="col-xl-4 mb-8">
                            <!--begin::Nav Panel Widget 4-->
                            <div class="card card-custom card-stretch gutter-b">
                                <!--begin::Body-->
                                <div class="card-body px-0 pt-0  shadow-sm">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex justify-content-between flex-column h-100">
                                        <!--begin::Container-->
                                        <div class="h-100">
                                            <!--begin::Header-->
                                            <div class="d-flex flex-column flex-center">
                                                <!--begin::Image-->
                                                <div class="bgi-no-repeat bgi-size-cover rounded w-100"
                                                    style="background-image: url('{{ $record->images()->first() ? asset($record->images()->first()->path) : asset('dashboard_assets/media/empty.jpeg') }}');min-height: 200px;">
                                                </div>
                                                <!--end::Image-->

                                                <!--begin::Text-->
                                                <div class="font-weight-bold text-dark-50 font-size-sm py-4">
                                                    {{ __('dash.date_start') }} ,
                                                    <span class="" style="color:#104a7c">
                                                        {{ $record->date_start }}</span>
                                                </div>
                                                <!--end::Text-->
                                                <!--begin::Text-->
                                                <div class="font-weight-bold text-dark-50 font-size-sm pb-7">
                                                    {{ __('dash.date_end') }} ,
                                                    <span style="color:#104a7c"> {{ $record->date_end }}</span>
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Header-->

                                            <!--begin::Body-->
                                            <div class="pt-1">
                                                <!--begin::Item-->

                                                <!--end::Item-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--eng::Container-->

                                        <!--begin::Footer-->
                                        <div class="d-flex flex-center mb-6">
                                            <a href="{{ route('dashboard.events.show', $record) }}"
                                                class="btn btn-primary">{{ __('dash.show') }}</a>
                                        </div>

                                        <!--end::Footer-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Nav Panel Widget 4-->
                        </div>
                    @endforeach
                </div>
                @if ($data->count() == 12)
                    <div class="d-flex align-items-center justify-content-end mt-16  mb-12">
                        <div class="d-flex align-items-center justify-content-center gap-6">
                            <span>{{ __('dash.pages') }}</span>
                            {{ $data->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection

@push('style')
    <style>
        [aria-label="Pagination Navigation"] div:first-child,
        [aria-label="Pagination Navigation"] [aria-label="&laquo; Previous"],
        [aria-label="Pagination Navigation"] [aria-label="Next &raquo;"] {
            display: none
        }

        [aria-label="Pagination Navigation"] div:last-child span.relative.z-0.inline-flex.shadow-sm.rounded-md {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush
