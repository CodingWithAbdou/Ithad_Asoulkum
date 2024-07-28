@if ($model->route_key == 'admins' || $model->route_key == 'agents')
    <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary">
        {{ __('dash.add') }}
        {{ $model->route_key == 'constants' ? __('dash.constant-option') : __('dash.' . $model->route_key) }}
    </a>
@else
    <a href="{{ route('dashboard.' . $model->route_key . '.create') }}" class="btn btn-primary">
        {{ __('dash.add') }}
        {{ $model->route_key == 'constants' ? __('dash.constant-option') : __('dash.' . $model->route_key) }}
    </a>
@endif
