<div class="{{ isset($col) ? 'col-md-' . $col : 'col-md-6' }} mb-10">
    <label class="form-label {{ isset($required) ? 'required' : '' }}">{{ $label }}</label>
    <input type="number" name="{{ $name }}" id="{{ $name }}" class="form-control form-control-solid "
        placeholder="{{ __('dash.enter') }} {{ $label }}" maxlength="70" step="0.01"
        value="{{ isset($data) ? old($name, $data) : old($name) }}" />
    {{-- @isset($hint)<div class="text-muted fs-7">{{$hint}}</div>@endif --}}
</div>
