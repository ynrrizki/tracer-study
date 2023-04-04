@switch($type)
    @case('text')
        <div class="form-group">
            <label for="{{ $name }}">{{ $label }}</label>
            <input type="text" id="{{ $name }}" class="form-control" value="{{ old($name, $value ?? '') }}"
                name="{{ $name }}">
        </div>
    @break

    @case('select')
        <div class="form-group">
            <label for="{{ $name }}">{{ $label }}</label>
            <select name="{{ $name }}" id="{{ $name }}" class="form-control">
                {!! $options !!}
            </select>
        </div>
    @break

    @default
@endswitch
