<div class="form-control">
    <label for="status" class="label">
        {{ $question->name }}
    </label>
    @foreach ($question->optionInputs as $option)
        <label class="label cursor-pointer w-1/4">
            <input class="radio checked:bg-primary @error($wireModel) radio-error @enderror" type="radio"
                name="{{ $question->id }}" id="{{ $option->name }}" wire:model="{{ $wireModel }}"
                value="{{ $option->name }}" @checked($fill == $option->name)>
            <span class="label-text ml-3 w-full" for="{{ $option->name }}">
                {{ $option->name }}
            </span>
        </label>
    @endforeach
    @error($wireModel)
        <label class="label">
            <span class="label-text-alt">{{ $message }}</span>
        </label>
    @enderror
</div>
