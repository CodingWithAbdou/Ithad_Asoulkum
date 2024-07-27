<div class="{{ isset($col) ? 'col-md-' . $col : 'col-md-6' }} mb-10">
    <label class="form-label {{ isset($required) ? 'required' : '' }}">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-select form-select-solid" data-control="select2"
        data-hide-search="true" data-placeholder="{{ __('dash.choose') }} {{ $label }}">
        <option></option>
        @foreach ($list as $item)
            <option value="{{ $item[$optionValue] }}"
                @isset($data)
                {{ $item[$optionValue] == $data ? 'selected' : '' }}
            @endisset>
                {{ $item[$optionName] }}</option>
        @endforeach
    </select>
    {{-- @isset($hint)<div class="text-muted fs-7 mt-1 ms-1">{{$hint}}</div>@endif --}}
</div>
