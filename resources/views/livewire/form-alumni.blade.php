<div class="w-full p-5">
    <div class="w-full mt-5 flex flex-col items-center">
        <img class="w-28 mb-20 logo-shadow p-5 rounded-full bg-white " src="{{ asset('assets/logo/logo.png') }}"
            alt="Prestasi Prima">
        <div class="stepwizard mb-10">
            <div class="stepwizard-row">
                <div class="stepwizard-step">
                    <button type="button" wire:click="back(1)"
                        class="btn {{ $currentStep >= 1 ? 'btn-primary' : 'btn-disable' }} rounded-full">1</button>
                    <p class="mt-2 {{ $currentStep >= 1 ? 'text-primary' : 'text-gray-600' }}">Data Umum</p>
                </div>
                <div class="stepwizard-step">
                    <button type="button" wire:click="back(2)"
                        class="btn {{ $currentStep >= 2 ? 'btn-primary' : 'btn-disable cursor-default' }} rounded-full"
                        {{ $currentStep >= 2 ? '' : 'disabled' }}>2</button>
                    <p class="mt-2 {{ $currentStep >= 2 ? 'text-primary' : 'text-gray-600' }}">Pertanyaan Survey</p>
                </div>
                <div class="stepwizard-step">
                    <button type="button"
                        class="btn {{ $currentStep == 3 ? 'btn-primary' : 'btn-disable' }} rounded-full cursor-default"
                        {{ $currentStep == 3 ? '' : 'disabled' }}>3</button>
                    <p class="mt-2 {{ $currentStep == 3 ? 'text-primary' : 'text-gray-600' }}">Feed Back</p>
                </div>
            </div>
        </div>
    </div>
    <div class="border-solid border-t-4 border-primary rounded-xl shadow-xl card">
        <div class="card-body px-10">
            @if ($currentStep == 1)
                <form wire:submit.prevent="firstStepSubmit">
                    <div class="mb-4">
                        <label class="label">
                            <span class="label-text">Nama Alumni</span>
                        </label>
                        <input type="text" placeholder="Nama Alumni" class="form-control" value="{{ $alumni->name }}"
                            disabled />
                    </div>
                    <div class="mb-4">
                        <label class="label">
                            <span class="label-text">NIK</span>
                        </label>
                        <input type="text" placeholder="NIK" class="form-control" value="{{ $alumni->nik }}"
                            disabled />
                    </div>
                    <div class="mb-4">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" wire:model="email" disabled />
                    </div>
                    <div class="mb-4">
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
                    </div>
                    <div class="mb-4">
                        <label class="label">
                            <span class="label-text">Alamat</span>
                        </label>
                        <input type="text" placeholder="Alamat"
                            class="form-control @error('address') is-invalid @enderror" wire:model="address" />
                        @error('address')
                            <label class="invalid-feedback">
                                <span>{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="label">
                            <span class="label-text">Tanggal Lahir</span>
                        </label>
                        <input type="date" placeholder="Tanggal Lahir"
                            class="form-control form-date @error('birth_date') is-invalid @enderror"
                            wire:model="birth_date" />
                        @error('birth_date')
                            <label class="invalid-feedback">
                                <span>{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="label">
                            <span class="label-text">Nomer Handphone</span>
                        </label>
                        <input type="text" placeholder="Nomer HP"
                            class="form-control @error('phone') is-invalid @enderror" wire:model.defer="phone" />
                        @error('phone')
                            <label class="invalid-feedback">
                                <span>{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="flex mt-10 justify-end">
                        <button type="submit" class="group btn btn-active btn-primary text-white">
                            <span class="sm:inline-block sm:mr-1 align-middle">Lanjut</span>
                            <i class="bx bx-chevron-right bx-sm me-sm-n2 group-hover:animate-pulse"></i>
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
                            @includeWhen($question->typeInput->name == 'text', 'partials.field.text', [
                                'question' => $question,
                                'fill' => $fill,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                            @includeWhen($question->typeInput->name == 'select', 'partials.field.select', [
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
                            @includeWhen($question->typeInput->name == 'radio', 'partials.field.radio', [
                                'question' => $question,
                                'fill' => $fill,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                            @includeWhen($question->typeInput->name == 'date', 'partials.field.date', [
                                'question' => $question,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                        @endif
                    @endforeach
                    <div class="flex mt-10 justify-between">
                        <div class="btn btn-secondary mr-4 group" wire:click="back(1)">
                            <i class="bx bx-chevron-left bx-sm me-sm-n2 group-hover:animate-pulse"></i>
                            <span class="sm:inline-block sm:mr-1 align-middle">Kembali</span>
                        </div>
                        <button type="submit" class="group btn btn-active btn-primary text-white">
                            <span class="sm:inline-block sm:mr-1 align-middle">Dikit Lagi</span>
                            <i class="bx bx-chevron-right bx-sm me-sm-n2 group-hover:animate-pulse"></i>
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
                            @includeWhen($question->typeInput->name == 'text', 'partials.field.text', [
                                'question' => $question,
                                'fill' => $fill,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                            @includeWhen($question->typeInput->name == 'select', 'partials.field.select', [
                                'question' => $question,
                                'fill' => $fill,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                            @includeWhen($question->typeInput->name == 'checkbox', 'partials.field.checkbox', [
                                'question' => $question,
                                'fill' => $fill,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                            @includeWhen($question->typeInput->name == 'radio', 'partials.field.radio', [
                                'question' => $question,
                                'fill' => $fill,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                            @includeWhen($question->typeInput->name == 'date', 'partials.field.date', [
                                'question' => $question,
                                'wireModel' => 'survey.' . $question->id,
                            ])
                        @endif
                    @endforeach
                    <div class="flex justify-between mt-10">
                        <div class="btn btn-secondary mr-4 group" wire:click="back(2)">
                            <i class="bx bx-chevron-left bx-sm me-sm-n2 group-hover:animate-pulse"></i>
                            <span class="sm:inline-block sm:mr-1 align-middle">Kembali</span>
                        </div>
                        <button type="submit" class="group btn btn-active btn-primary text-white">
                            <span class="sm:inline-block sm:mr-1 align-middle">Yak Nice!</span>
                            <i class="bx bx-chevron-right bx-sm me-sm-n2 group-hover:animate-pulse"></i>
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
