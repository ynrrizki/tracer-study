<div class="mb-3 fv-plugins-icon-container">
    @isset($label)
        <label class="form-label" for="{{ $name }}">{!! $label !!}</label>
    @endisset
    @isset($type)
        @switch($type)
            @case('text')
                <input type="text" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
                    placeholder="{{ $placeholder }}" name="{{ $name }}" aria-label="{{ $placeholder }}"
                    value="{{ old($name, $value ?? '') }}">
            @break

            @case('email')
                <input type="email" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
                    placeholder="{{ $placeholder }}" name="{{ $name }}" aria-label="{{ $placeholder }}"
                    value="{!! old($name, $value ?? '') !!}">
            @break

            @case('number')
                <input type="number" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
                    placeholder="{{ $placeholder }}" name="{{ $name }}" aria-label="{{ $placeholder }}"
                    value="{!! old($name, $value ?? '') !!}">
            @break

            @case('month')
                <input type="month" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
                    placeholder="{{ $placeholder ?? '' }}" name="{{ $name }}" aria-label="{{ $placeholder ?? '' }}"
                    value="{!! old($name, $value ?? '') !!}">
            @break

            @case('year')
                <input type="number" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
                    placeholder="{{ $placeholder ?? '' }}" name="{{ $name }}" aria-label="{{ $placeholder ?? '' }}"
                    value="{!! old($name, $value ?? '') !!}" min="1900" max="{{ date('Y') }}">
            @break

            @case('date')
                <input type="date" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
                    placeholder="{{ $placeholder ?? '' }}" name="{{ $name }}" aria-label="{{ $placeholder ?? '' }}"
                    value="{!! old($name, $value ?? '') !!}">
            @break

            @case('password')
                <input type="password" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
                    placeholder="{{ $placeholder }}" name="{{ $name }}" aria-label="{{ $placeholder }}"
                    value="{!! old($name, $value ?? '') !!}">
            @break

            @case('select')
                <select name="{{ $name }}" id="{{ $name }}"
                    class="form-select @error($name) is-invalid @enderror
                    ">
                    {!! $options !!}
                </select>
            @break

            @case('textarea')
                <textarea id="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
                    placeholder="{{ $placeholder }}" aria-label="{{ $placeholder }}" name="{{ $name }}"
                    value="{{ old($name, $value ?? '') }}"></textarea>
            @break

            @default
        @endswitch
    @endisset
    @error($name)
        <div class="fv-plugins-message-container invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
