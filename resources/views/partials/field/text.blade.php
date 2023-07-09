<div class="mb-4">
    <label for="status" class="label">
        {{ $question->name }}
    </label>
    <input type="text" class="form-control @error($wireModel) is-invalid @enderror" id="{{ $question->id }}"
        name="{{ $question->id }}" wire:model="{{ $wireModel }}" required="{{ $question->required }}">
    @error($wireModel)
        <label class="invalid-feedback">
            <span>{{ $message }}</span>
        </label>
    @enderror
</div>
