<div class="form-group" data-select2-id="43">
    <label>{{ $question->name }}</label>
    <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
        aria-hidden="true">
        @foreach ($question->optionInputs as $option)
            <option value="{{ $option->id }}">{{ $option->name }}</option>
        @endforeach
    </select>

</div>
