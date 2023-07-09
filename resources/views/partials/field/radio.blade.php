<div class="form-check mb-4">
    <label for="status" class="label block mb-2">
        {{ $question->name }}
    </label>
    @foreach ($question->optionInputs as $option)
        <div class="flex ml-6">
            <input
                class="hover:cursor-pointer absolute mt-1 -ml-6 appearance-none checked:bg-primary hover:checked:bg-primary-400 @error($wireModel) radio-error @enderror"
                type="radio" name="{{ $question->id }}" id="{{ $option->name }}" wire:model="{{ $wireModel }}"
                value="{{ $option->name }}" @checked($fill == $option->name) for="{{ $option->name }}">
            <label class="hover:cursor-pointer inline-block text-gray-500 mb-0" for="{{ $option->name }}">
                {{ $option->name }}
            </label>
        </div>
    @endforeach
    @error($wireModel)
        <label class="label">
            <span class="label-text-alt">{{ $message }}</span>
        </label>
    @enderror
</div>
