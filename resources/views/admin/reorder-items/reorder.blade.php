@extends('admin.layouts.main')

@section('title')
    <div class="page-title d-flex flex-column me-3">
        <h1 class="d-flex text-dark fw-bolder my-1 fs-3">{{ $model->{'title_' . app()->getLocale()} }}</h1>
        <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
            <li class="breadcrumb-item text-gray-600">
                <a href="{{ route('dashboard.home') }}" class="text-gray-600 text-hover-primary">{{ __('dash.home') }}</a>
            </li>
            <li class="breadcrumb-item text-gray-600">
                <a href="{{ isset($id) ? route('dashboard.' . $model->route_key . '.index', $id) : route('dashboard.' . $model->route_key . '.index') }}"
                    class="text-gray-600 text-hover-primary">{{ $model->{'title_' . app()->getLocale()} }}</a>
            </li>
            <li class="breadcrumb-item text-gray-600">{{ __('dash.reorder_data') }}</li>
        </ul>
    </div>
    <div class="d-flex align-items-center py-2 py-md-1"></div>
@endsection

@section('content')
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <!--begin::General options-->
        <div class="card card-flush">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 draggable-zone sortable main-list" id="cards_div">
                        @if (!empty($list))
                            @foreach ($list as $item)
                                <!--begin::Card-->
                                <div data-sectionid="{{ $item->id }}"
                                    class="card card-custom mb-2 draggable slider-order-div">
                                    <div class="card-header draggable-handle border">
                                        <div class="card-title">
                                            <h3 class="card-label">
                                                {{ $item->{'question_' . getLocale()} ?? $item->{'title_' . getLocale()} }}
                                            </h3>
                                        </div>
                                        <div class="card-toolbar">
                                            <a class="btn btn-icon btn-sm btn-hover-light-primary" data-container="body">
                                                <i class="fas fa-arrows-alt-v"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card-->
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('dashboard.' . $model->route_key . '.index') }}" id="kt_ecommerce_add_product_cancel"
                class="btn btn-light me-5">Cancel</a>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $(".main-list div.slider-order-div").each(function(e) {
                $(this).attr('data-itemid', e + 1);
            });
            reSort();
        });

        function reSort() {
            $(".sortable").disableSelection();
            $(".sortable").sortable({
                start: function(evt, ui) {},
                stop: function(evt, ui) {
                    let item_order_list = [];
                    let item_id_list = [];
                    setTimeout(
                        function() {
                            $(".main-list div.slider-order-div").each(function(e) {
                                $(this).attr('data-itemid', e + 1);
                                let id = $(this).attr('data-sectionid');
                                let order = e + 1;
                                item_id_list.push(id);
                                item_order_list.push(order);
                            });
                            let segment = '{{ $model->route_key }}';
                            let csrf = '{{ csrf_token() }}';
                            $.post('{{ route('dashboard.reorder.update') }}', {
                                idList: item_id_list,
                                orderList: item_order_list,
                                _token: csrf,
                                segment: segment,
                            }, function(data) {
                                if (data.status) {
                                    toastr.success(data.msg);
                                } else {
                                    toastr.error(data.msg);
                                }
                            });
                        },
                        200
                    )
                }
            });
        }
    </script>
@endpush
