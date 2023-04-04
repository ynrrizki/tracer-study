<div class="form-control">
    <label for="status" class="label">
        {{ $question->name }}
    </label>
    <input type="text" class="input input-bordered @error($wireModel) input-error @enderror" id="{{ $question->id }}"
        name="{{ $question->id }}" wire:model="{{ $wireModel }}">
    @error($wireModel)
        <label class="label">
            <span class="label-text-alt">{{ $message }}</span>
        </label>
    @enderror
</div>
