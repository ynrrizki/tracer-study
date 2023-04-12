<div class="row g-4 mb-4">
    @isset($finished_filling)
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Yang Sudah Mengisi</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $finished_filling }}</h4>
                                {{-- <small class="text-success">(+29%)</small> --}}
                            </div>
                            <small>Total Alumni</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="bx bx-user bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @isset($currently_filling)
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Yang sedang mengisi</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $currently_filling }}</h4>
                                {{-- <small class="text-success">(+42%)</small> --}}
                            </div>
                            <small>Total Alumni</small>
                        </div>
                        <span class="badge bg-label-warning rounded p-2">
                            <i class="bx bx-user-voice bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @isset($survey_question)
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Pertanyaan Survey</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $survey_question }}</h4>
                                {{-- <small class="text-success">(+42%)</small> --}}
                            </div>
                            <small>Total Pertanyaan</small>
                        </div>
                        <span class="badge bg-label-info rounded p-2">
                            <i class="bx bx-book bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @isset($feedback_question)
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Pertanyaan Feedback</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $feedback_question }}</h4>
                                {{-- <small class="text-success">(+42%)</small> --}}
                            </div>
                            <small>Total Pertanyaan</small>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                            <i class="bx bx-book bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
