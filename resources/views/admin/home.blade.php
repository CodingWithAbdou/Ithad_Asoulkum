@extends('admin.layouts.main')

@section('title')
    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('dash.home') }}</h1>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-dark">{{ __('dash.home') }}</li>
    </ul>
@endsection

@section('content')
    <div class="row">

        @admin
            <a href="{{ route('dashboard.reservations.index') }}" class="col-xl-3 col-md-6 mb-4">
                <div class="card  shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-3">
                                    {{ __('dash.number_reservation') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ">{{ App\Models\Reservation::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-briefcase fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('dashboard.join_us.index') }}" class="col-xl-3 col-md-6 mb-4">
                <div class="card  shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-3">
                                    {{ __('dash.number_join_us') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ">{{ App\Models\JoinUs::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('dashboard.offers.index') }}" class="col-xl-3 col-md-6 mb-4">
                <div class="card  shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-3">
                                    {{ __('dash.number_offers') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ">{{ App\Models\Offer::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-share-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('dashboard.events.index') }}" class="col-xl-3 col-md-6 mb-4">
                <div class="card  shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-3">
                                    {{ __('dash.number_events') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ">{{ App\Models\Event::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-lightbulb fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('dashboard.agents.index') }}" class="col-xl-3 col-md-6 mb-4">
                <div class="card  shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-3">
                                    {{ __('dash.number_agents') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ">
                                    {{ App\Models\User::where('role_id', '2')->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endadmin
        @agent
            <a href="{{ route('dashboard.my_offers.index') }}" class="col-xl-3 col-md-6 mb-4">
                <div class="card  shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-3">
                                    {{ __('dash.number_my_offers') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ">
                                    {{ auth()->user()->offers->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-share-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('dashboard.events.index') }}" class="col-xl-3 col-md-6 mb-4">
                <div class="card  shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-3">
                                    {{ __('dash.number_events') }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ">{{ App\Models\Event::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-lightbulb fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endagent
    </div>
@endsection
