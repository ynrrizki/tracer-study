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



{{-- <div class="mb-4">
    <label class="label">
        <span class="label-text">Jurusan</span>
    </label>
    <select class="form-select @error('major') is-invalid @enderror" wire:model="major">
        <option disabled selected value="">Pilih Jurusan</option>
        @foreach ($majors as $major)
            <option value="{{ $major->id }}">{{ $major->name }}</option>
        @endforeach
    </select>
    @error('major')
        <label class="invalid-feedback">
            <span>{{ $message }}</span>
        </label>
    @enderror
</div> --}}
