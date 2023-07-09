<div class="mb-4">
    <label class="label">
        <span class="label-text">
            {{ $question->name }}
        </span>
    </label>
    <select class="form-select @error($wireModel) is-invalid @enderror" wire:model="{{ $wireModel }}">
        <option disabled value="" selected>-------- Pilih --------</option>
        @foreach ($question->optionInputs as $option)
            <option value="{{ $option->name }}">{{ $option->name }}</option>
        @endforeach
    </select>
    @error('{{ $wireModel }}')
        <label class="invalid-feedback">
            <span>{{ $message }}</span>
        </label>
    @enderror
</div>
