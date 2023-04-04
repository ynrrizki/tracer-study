<div class="mb-4 radio">
    <label class="form-label">{{ $question->name }}</label>
    @foreach ($question->optionInputs as $option)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="{{ $option->name }}" value="{{ $option->id }}">
            <label class="form-check-label">{{ $option->name }}</label>
        </div>
    @endforeach
</div>
