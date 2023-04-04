<div>
    <div class="card shadow bg-white">
        <div class="card-body">
            <ul class="steps steps-vertical lg:steps-horizontal">
                <li
                    class="step {{ $currentStep >= 1 ? 'step-primary text-primary' : 'step-secondary text-secondary' }} font-bold">
                    Data Umum
                </li>
                <li
                    class="step {{ $currentStep >= 2 ? 'step-primary text-primary' : 'step-secondary text-secondary' }} font-bold">
                    Survey
                </li>
                <li
                    class="step {{ $currentStep == 3 ? 'step-primary text-primary' : 'step-secondary text-secondary' }} font-bold">
                    Feed Back
                </li>
            </ul>
        </div>
    </div>

    <div class="card shadow my-20 bg-white">
        <div class="card-body">

            @if ($currentStep == 1)
                <form wire:submit.prevent="firstStepSubmit">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama Alumni</span>
                        </label>
                        <input type="text" placeholder="Nama Alumni" class="input input-bordered"
                            value="{{ $alumni->name }}" disabled />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">NIK</span>
                        </label>
                        <input type="text" placeholder="NIK" class="input input-bordered" value="{{ $alumni->nik }}"
                            disabled />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" placeholder="Email" class="input input-bordered" wire:model="email"
                            disabled />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Jurusan</span>
                        </label>
                        <select class="select select-bordered @error('major') select-error @enderror"
                            wire:model="major">
                            <option disabled selected value="">Pilih Jurusan</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                        @error('major')
                            <label class="label">
                                <span class="label-text-alt">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Alamat</span>
                        </label>
                        <input type="text" placeholder="Alamat"
                            class="input input-bordered @error('address') input-error @enderror" wire:model="address" />
                        @error('address')
                            <label class="label">
                                <span class="label-text-alt">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Tanggal Lahir</span>
                        </label>
                        <input type="date" placeholder="Tanggal Lahir"
                            class="input input-bordered @error('birth_date') input-error @enderror"
                            wire:model="birth_date" />
                        @error('birth_date')
                            <label class="label">
                                <span class="label-text-alt">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nomer Handphone</span>
                        </label>
                        <input type="text" placeholder="Nomer HP"
                            class="input input-bordered @error('phone') input-error @enderror"
                            wire:model.defer="phone" />
                        @error('phone')
                            <label class="label">
                                <span class="label-text-alt">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="flex mt-5">
                        <button type="submit" class="btn btn-active btn-primary text-white">
                            Next
                        </button>
                    </div>
                </form>
            @endif
            @if ($currentStep == 2)
                <form wire:submit.prevent="secondStepSubmit">
                    @foreach ($questions as $question)
                        @if ($question->category_id == 4)
                            @php
                                $answer = $answers->where('question_id', $question->id)->first();
                                $fill = $answer->fill ?? '';
                            @endphp
                            @includeWhen($question->typeInput->name == 'text', 'partials.question.text', [
                                'question' => $question,
                                'fill' => $fill,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                            @includeWhen($question->typeInput->name == 'select', 'partials.question.select', [
                                'question' => $question,
                                'fill' => $fill,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                            @includeWhen(
                                $question->typeInput->name == 'checkbox',
                                'partials.question.checkbox',
                                [
                                    'question' => $question,
                                    'fill' => $fill,
                                    'wireModel' => 'survey.' . $question->id,
                                ]
                            )
                            @includeWhen($question->typeInput->name == 'radio', 'partials.question.radio', [
                                'question' => $question,
                                'fill' => $fill,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                            @includeWhen($question->typeInput->name == 'date', 'partials.question.date', [
                                'question' => $question,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                        @endif
                    @endforeach
                    <div class="flex mt-5">
                        <div class="btn btn-outline mr-4" wire:click="back(1)">
                            Back
                        </div>
                        <button type="submit" class="btn btn-active btn-primary text-white">
                            Next
                        </button>
                    </div>
                </form>
            @endif
            @if ($currentStep == 3)
                <form wire:submit.prevent="thirdStepSubmit">
                    @foreach ($questions as $question)
                        @if ($question->category_id == 5)
                            @php
                                $answer = $answers->where('question_id', $question->id)->first();
                                $fill = $answer->fill ?? '';
                            @endphp
                            @includeWhen($question->typeInput->name == 'text', 'partials.question.text', [
                                'question' => $question,
                                'fill' => $fill,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                            @includeWhen($question->typeInput->name == 'select', 'partials.question.select', [
                                'question' => $question,
                                'fill' => $fill,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                            @includeWhen(
                                $question->typeInput->name == 'checkbox',
                                'partials.question.checkbox',
                                [
                                    'question' => $question,
                                    'fill' => $fill,
                                    'wireModel' => 'survey.' . $question->id,
                                ]
                            )
                            @includeWhen($question->typeInput->name == 'radio', 'partials.question.radio', [
                                'question' => $question,
                                'fill' => $fill,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                            @includeWhen($question->typeInput->name == 'date', 'partials.question.date', [
                                'question' => $question,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                        @endif
                    @endforeach
                    <div class="flex mt-5">
                        <div class="btn btn-outline mr-4" wire:click="back(2)">
                            Back
                        </div>
                        <button type="submit" class="btn btn-active btn-primary text-white">
                            Save
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
