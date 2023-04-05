<div class="form-control">
    <label for="status" class="label">
        {{ $question->name }}
    </label>
    <select class="select select-bordered @error($wireModel) select-error @enderror" aria-label="Default select example"
        name="{{ $question->id }}">
        <option selected disabled>-------- Pilih --------</option>
        @foreach ($question->optionInputs as $option)
            <option value="{{ $option->name }}" @selected($fill == $option->name)>
                {{ $option->name }}</option>
        @endforeach
    </select>
    @error('{{ $wireModel }}')
        <label class="label">
            <span class="label-text-alt">{{ $message }}</span>
        </label>
    @enderror
</div>
