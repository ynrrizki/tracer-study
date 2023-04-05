@extends('layouts.dash')

@section('header')
    Question Management
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Question</li>
@endsection

@section('content')
    @push('addon-css')
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <style>
            .question-card {
                cursor: pointer;
            }

            .border-active {
                border-left: 3px solid var(--bs-orange) !important;
                pointer-events: none;
            }

            .move {
                opacity: 0.0;
            }

            .move:hover {
                opacity: 1;
                cursor: move;
            }
        </style>
    @endpush

    <div class="row mt-4">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <h4 class="mt-2 mb-4">Form Pertanyaan</h4>
            {{-- CARD FORM PERTANYAAN --}}
            <div class="card mb-4">
                <form action="{{ route('question.save') }}" method="POST" id="form-question">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="category" value="4" id="category">
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="inputQuestionTitle" class="form-label">Judul Pertanyaan</label>
                            <input type="text" class="form-control" id="inputQuestionTitle" placeholder="Enter title"
                                name="name" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Tipe Input</label>
                            <select class="form-control type-input" id="inputQuestionTypeInput" name="type_input" required>
                                <option selected value="" disabled>Choose Option....</option>
                                @foreach ($typeInputs as $typeInput)
                                    @if ($typeInput->name != 'date' && $typeInput->name != 'checkbox' && $typeInput->name != 'select')
                                        <option value="{{ $typeInput->id }}">{{ $typeInput->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default float-right" onclick="unActiveCard()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="form-question-category col-lg-7 col-md-7 col-xl-8">
            <div class="nav-align-top">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" id="survey-tab" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-survey" aria-controls="navs-pills-top-survey"
                            aria-selected="true">Survey</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" id="feedback-tab" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-feedback" aria-controls="navs-pills-top-feedback"
                            aria-selected="false">Feed Back</button>
                    </li>
                </ul>
                <div class="tab-content p-0" style="background: none; box-shadow: none;">
                    {{-- <div class="col-lg-8 col-md-7"> --}}
                    <div class="tab-pane fade show active" id="navs-pills-top-survey" role="tabpanel">
                        <div class="sortable">
                            @foreach ($surveyQuestions as $question)
                                {{-- CARD LIST PERTANYAAN --}}
                                <div class="question-card card mb-3" id="question-card-{{ $question->id }}"
                                    data-question="{{ json_encode($question) }}">
                                    <div class="move w-full d-flex justify-content-center">
                                        <i class='bx bx-grid-horizontal'></i>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-9">
                                                @includeWhen(
                                                    $question->typeInput->name == 'text',
                                                    'partials.dash.question.text',
                                                    ['question' => $question]
                                                )
                                                @includeWhen(
                                                    $question->typeInput->name == 'radio',
                                                    'partials.dash.question.radio',
                                                    ['question' => $question]
                                                )
                                                @includeWhen(
                                                    $question->typeInput->name == 'select',
                                                    'partials.dash.question.select',
                                                    [['question' => $question]]
                                                )
                                                @includeWhen(
                                                    $question->typeInput->name == 'date',
                                                    'partials.dash.question.date',
                                                    ['question' => $question]
                                                )
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade questions sortable" id="navs-pills-top-feedback" role="tabpanel">
                        <div class="sortable">
                            @foreach ($feedBackQuestions as $question)
                                <div class="question-card card mb-3" id="question-card-{{ $question->id }}"
                                    data-question="{{ json_encode($question) }}">
                                    <div class="move w-full d-flex justify-content-center"><i
                                            class='bx bx-grid-horizontal'></i></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-9">
                                                @includeWhen(
                                                    $question->typeInput->name == 'text',
                                                    'partials.dash.question.text',
                                                    ['question' => $question]
                                                )
                                                @includeWhen(
                                                    $question->typeInput->name == 'radio',
                                                    'partials.dash.question.radio',
                                                    ['question' => $question]
                                                )
                                                @includeWhen(
                                                    $question->typeInput->name == 'select',
                                                    'partials.dash.question.select',
                                                    [['question' => $question]]
                                                )
                                                @includeWhen(
                                                    $question->typeInput->name == 'date',
                                                    'partials.dash.question.date',
                                                    ['question' => $question]
                                                )
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-5" id="option_input">

        </div>
        {{-- <div class="col-md-4 mt-5">
            <form action="http://127.0.0.1:8000/dashboard/questions/options-input/save" method="POST" id="form-add-option">
                <input type="hidden" name="_token" value="sBHCxbc0Mu8rmTDs86GXNLkOBdkFPSLSK3bn7ttO">

                <div class="card d-flex justify-content-between">
                    <input type="hidden" id="questionId" name="question_id" value="1">
                    <div class="option-input-card card-body">
                        <div class="card-title d-flex justify-content-between">
                            <div class="card-action-title">Add Option</div>
                            <div class="card-action-element">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="javascript:void(0);" class="card-collapsible"><button type="button"
                                                class="btn btn-secondary"><i class='bx bx-plus'></i></button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputOption">Option</label>

                            <div class="input-group mb-3">
                                <input type="hidden" id="optionInputId-1" name="typeInputId[]" value="1">
                                <input type="text" class="form-control" id="inputOption-1" name="optionName[]"
                                    placeholder="Enter Option Name" value="Bekerja" required="">
                            </div>

                            <div class="input-group mb-3">
                                <input type="hidden" id="optionInputId-2" name="typeInputId[]" value="2">
                                <input type="text" class="form-control" id="inputOption-1" name="optionName[]"
                                    placeholder="Enter Option Name" value="Kuliah" required="">
                            </div>

                            <div class="input-group mb-3" id="inputGroup-3">
                                <input type="hidden" id="optionInputId-3" name="typeInputId[]" value="3">
                                <input type="text" class="form-control" id="inputOption-3" name="optionName[]"
                                    placeholder="Enter Option Name" required="" value="Wirausaha (Freelance/Online)">
                                <form action="http://127.0.0.1:8000/dashboard/questions/options-input/delete"
                                    method="POST">
                                    <input type="hidden" name="_token"
                                        value="sBHCxbc0Mu8rmTDs86GXNLkOBdkFPSLSK3bn7ttO">
                                    <span class="input-group-append">
                                        <input type="hidden" name="id" value="3">
                                        <button type="submit" class="btn btn-danger" id="deleteButton-3"><i
                                                class="bx bxs-trash"></i></button>
                                    </span>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="reset" class="btn btn-warning">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div> --}}

    </div>
    @push('addon-js')
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script>
            $(document).ready(function() {
                // Ketika nav di klik
                $('.nav-link').click(function() {
                    // Ambil ID nav yang di klik
                    let navID = $(this).attr('id');
                    let categoryID = 4;
                    switch (navID) {
                        case 'survey-tab':
                            categoryID = 4;
                            break;
                        case 'feedBack-tab':
                            categoryID = 5;
                            break;
                        default:
                            break;
                    }

                    $('#category').val(categoryID);
                    // Simpan ID nav ke dalam web storage
                    localStorage.setItem('activeNav', navID);
                });

                // Cek apakah ada data activeNav di dalam web storage
                let activeNav = localStorage.getItem('activeNav');

                // Jika ada, set activeNav sebagai active nav
                if (activeNav !== null) {
                    $('#' + activeNav).tab('show');
                }
            });
            @foreach ($surveyQuestions as $question)
                @php
                    $questionId = $question->id;
                @endphp
                $(document).on('click', '#question-card-{{ $questionId }}', function() {
                    if (!$(this).hasClass('border-active')) {
                        let data = JSON.parse($(this).attr('data-question'));
                        activeCard(this, data);
                        let button = `<div class="form-group mb-5 question-card-button">
                        <button type="button" class="btn btn-warning question-card-cancel" onclick="questionCardButton('cancel', {{ $questionId }})">Cancel</button>
                        <button class="btn btn-danger open-modal" data-toggle="modal" data-target="#modal-default" onclick="questionCardButton('delete', ${JSON.stringify(data).replace(/"/g, '&quot;')})">Delete</button>
                        </div>
                        `;
                        $(button).hide().insertAfter(this).fadeIn('slow');
                        isSelectedCard = true;

                    } else {
                        unActiveCard();
                        isSelectedCard = false;

                    }
                    widthCheck();
                });
            @endforeach

            @foreach ($feedBackQuestions as $question)
                @php
                    $questionId = $question->id;
                @endphp
                $(document).on('click', '#question-card-{{ $questionId }}', function() {
                    if (!$(this).hasClass('border-active')) {
                        let data = JSON.parse($(this).attr('data-question'));
                        activeCard(this, data);
                        let button = `<div class="form-group mb-5 question-card-button">
                        <button type="button" class="btn btn-warning question-card-cancel" onclick="questionCardButton('cancel')">Cancel</button>
                        <button class="btn btn-danger open-modal" data-toggle="modal" data-target="#modal-default" onclick="questionCardButton('delete', '{{ $question->name }}')">Delete</button>
                        </div>`;
                        $(button).hide().insertAfter(this).fadeIn('slow');
                    } else {
                        unActiveCard();
                    }
                    widthCheck();
                });
            @endforeach

            $(".type-input").change(function() {
                let form = `<form action="{{ route('optionInput.save') }}" method="POST" id="form-add-option">
                @csrf
                <div class="card d-flex justify-content-between">
                    <input type="hidden" id="questionId" name="question_id">
                    <div class="option-input-card card-body">
                        <div class="card-title d-flex justify-content-between">
                            <div class="card-action-title">Add Option</div>
                            <div class="card-action-element">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="javascript:void(0);" class="card-collapsible"><button type="button"
                                                class="btn btn-icon btn-secondary"><i class='bx bx-plus'></i></button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputOption" class="form-label">Option</label>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <button type="reset" class="btn btn-warning">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="mt-3">
                    <span>Tekan "Tab" untuk menambahkan opsi pada field</span>
                </div>
            </form>`;
                $(".type-input option:selected").each(function() {
                    if (($(this).text() == "select" || $(this).text() == "checkbox" || $(this).text() ==
                            "radio") && $('#id').val() != "") {
                        $('#option_input').empty();
                        $('#option_input').hide().append(form).fadeIn('slow');
                    } else {
                        $('#option_input').empty();
                    }
                });

            }).change();

            // Menambahkan input option pada tombol tambah
            $(document).on('click', '.card-title button', function() {
                appendOptionInput();
            });

            $(document).on('keydown', function(event) {
                if (event.key == 'Tab') {
                    appendOptionInput();
                }
            });

            // Menghapus input option pada tombol hapus
            $(document).on('click', '.input-group-append button', function() {
                let inputGroup = $(this).closest('.input-group');
                let inputHidden = inputGroup.find('input[name="typeInputId[]"]');
                let deleteButton = inputGroup.find('button[type="submit"]');

                if (inputHidden.val().trim() !==
                    '') { // memeriksa apakah nilai input hidden tidak kosong atau hanya terdiri dari spasi
                    deleteButton.attr('type', 'submit'); // mengubah tipe button menjadi submit
                } else {
                    deleteButton.attr('type', 'button'); // mengubah tipe button menjadi button
                    let id = $(this).closest('.input-group').attr('id').split('-')[1];
                    let inputVal = $(`#inputGroup-${id} input`).val();
                    $(`#inputGroup-${id}`).remove();
                }
            });

            // drag and drop
            $(document).on('mouseover', '.sortable', function() {
                if ($('.question-card').hasClass("border-active")) {
                    $(this).sortable({
                        connectWith: ".question-card",
                        disabled: true,
                    }).disableSelection();
                } else {
                    $(this).sortable({
                        connectWith: ".question-card",
                        // axis: "y",
                        handle: ".move",
                        cancel: ".card.card-body",
                        disabled: false,
                        start: function(event, ui) {
                            ui.placeholder.html('<div class="card card-body bg-light mb-3"></div>');
                            ui.helper.addClass('card-shadow');
                        },
                        update: function(event, ui) {
                            updateQuestionOrder($(this), event, ui);
                        }
                    }).disableSelection();
                }
            });

            function updateQuestionOrder(sortable, event, ui) {
                let data = {};
                let order = [];
                $('.question-card').each(function(index, element) {
                    order.push({
                        id: $(this).data('question').id,
                        position: index + 1
                    });
                });
                // data.questions = ui.item.data('question');
                // data.cur_question_id = ui.item.data('question').id;
                // data.prev_question_id = ui.item.prev().data('question') ? ui.item.prev().data('question').id : null;
                // data.next_question_id = ui.item.next().data('question') ? ui.item.next().data('question').id : null;
                data.order = order;
                data._token = '{{ csrf_token() }}';
                console.log(data);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('question.order') }}',
                    dataType: "JSON",
                    data: data,
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }


            function appendOptionInput() {
                $('.option-input-card').append(fieldOptionInput());
            }

            $("#vert-tabs-tab").click(function() {
                unActiveCard();
            });

            function questionCardButton(
                option, data) {
                switch (option) {
                    case 'cancel':
                        unActiveCard();
                        break;
                    case 'delete':
                        $('#question_title').val(data.name);
                        $('#question_id').val(data.id);
                        break;
                    default:
                        break;
                }
            }



            function fieldOptionInput(data) {
                let inputGroup;
                let id = Date.now();

                if (data === undefined) {
                    inputGroup = `
                    <div class="input-group mb-3" id="inputGroup-${id}">
                        <input type="hidden" name="typeInputId[]" >
                        <input type="text" class="form-control"  name="optionName[]" placeholder="Enter Option Name" required>
                        <form action="{{ route('optionInput.delete') }}" method="POST">
                            @csrf
                            <span class="input-group-append">
                                <input type="hidden" name="id" >
                                <button type="submit" class="btn btn-danger" id="deleteButton"><i class='bx bxs-trash' ></i></button>
                            </span>
                        </form>

                    </div>
                `;
                } else {
                    inputGroup = `
                    <div class="input-group mb-3" id="inputGroup-${data.id}">
                        <input type="hidden" id="optionInputId-${data.id}" name="typeInputId[]" value="${data.id}">
                        <input type="text" class="form-control" id="inputOption-${data.id}" name="optionName[]" placeholder="Enter Option Name" required value="${data.name}">
                        <form action="{{ route('optionInput.delete') }}" method="POST">
                            @csrf
                            <span class="input-group-append">
                                <input type="hidden" name="id" value="${data.id}">
                                <button type="submit" class="btn btn-danger" id="deleteButton-${data.id}"><i class='bx bxs-trash' ></i></button>
                            </span>
                        </form>

                    </div>
                `;
                }


                return inputGroup;
            }

            // unActiveCard and isActiveCard
            function activeCard(selector, data) {
                unActiveCard();
                isActiveCard(selector, data);
            }

            function unActiveCard() {
                $('.question-card').removeClass('border-active');
                $('.question-card-button').remove();
                $('#id').val("");
                $('#inputQuestionTitle').val("");
                $('#inputQuestionTypeInput').val("").change();
                widthCheck();
            }

            function isActiveCard(selector, data) {
                $(selector).addClass('border-active');
                formQuestion(data);
                formAddOption(selector, data);
            }

            function formQuestion(data) {
                $('#id').val(data.id);
                $('#inputQuestionTitle').val(data.name);
                $('#inputQuestionTypeInput').val(data.type_input_id).change();
            }

            function widthCheck() {
                if ($('#form-add-option').length) {
                    $('.form-question-category').removeClass("col-xl-8");
                    $('.form-question-category').addClass("col-xl-4");
                } else {
                    $('.form-question-category').removeClass("col-xl-4");
                    $('.form-question-category').addClass("col-xl-8");
                }
            }

            function formAddOption(selector, data) {
                let radioId = $(selector).find('.radio > .form-check > input').map(function() {
                    return $(this).val();
                }).get();

                let radioLabel = $(selector).find('.radio > .form-check > label').map(function() {
                    return $(this).text();
                }).get();
                data.option_inputs.forEach((element, index) => {
                    if (index < 2) {
                        $('.option-input-card > .form-group').append(`
                    <div class="input-group mb-3">
                        <input type="hidden" id="optionInputId-${element.id}" name="typeInputId[]" value="${element.id}">
                        <input type="text" class="form-control" id="inputOption-1" name="optionName[]"
                        placeholder="Enter Option Name" value="${element.name}" required>
                    </div>
                            `);
                    } else {
                        $('.option-input-card > .form-group').append(fieldOptionInput(element));
                    }
                });
                $('#questionId').val(data.id);

                // $('#form-add-option').find('input[name="typeInputId[]"]').each(function(index, element) {
                //     $(element).val(radioId[index]);
                // });
                // $('#form-add-option').find('input[name="optionName[]"]').each(function(index, element) {
                //     $(element).val(radioLabel[index]);
                // });
            }
        </script>
    @endpush
@endsection







































{{-- <div class="col-md-3">
        <div class="sticky-top mb-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Question Categories</h4>
                </div>
                <div class="card-body">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                        aria-orientation="vertical">
                        <a class="nav-link active" id="vert-tabs-survey-tab" data-toggle="pill" href="#vert-tabs-survey"
                            role="tab" aria-controls="vert-tabs-survey" aria-selected="true">Survey</a>
                        <a class="nav-link" id="vert-tabs-feedBack-tab" data-toggle="pill" href="#vert-tabs-feedBack"
                            role="tab" aria-controls="vert-tabs-feedBack" aria-selected="false">FeedBack</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Question</h3>
                </div>
                <form action="{{ route('question.save') }}" method="POST" id="form-question">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="category" value="4" id="category">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputQuestionTitle">Question Title</label>
                            <input type="text" class="form-control" id="inputQuestionTitle" placeholder="Enter title"
                                name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Type Input</label>
                            <select class="form-control type-input" id="inputQuestionTypeInput" name="type_input" required>
                                <option selected value="" disabled>Choose Option....</option>
                                @foreach ($typeInputs as $typeInput)
                                    @if ($typeInput->name != 'date' && $typeInput->name != 'checkbox' && $typeInput->name != 'select')
                                        <option value="{{ $typeInput->id }}">{{ $typeInput->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default float-right" onclick="unActiveCard()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="tab-content" id="vert-tabs-tabContent">
            <div class="tab-pane text-left fade active show" id="vert-tabs-survey" role="tabpanel"
                aria-labelledby="vert-tabs-survey-tab">
                @foreach ($surveyQuestions as $question)
                    <div class="question-card card" id="question-card-{{ $question->id }}"
                        data-question="{{ json_encode($question) }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    @includeWhen(
                                        $question->typeInput->name == 'text',
                                        'partials.dash.question.text',
                                        ['question' => $question]
                                    )
                                    @includeWhen(
                                        $question->typeInput->name == 'radio',
                                        'partials.dash.question.radio',
                                        ['question' => $question]
                                    )
                                    @includeWhen(
                                        $question->typeInput->name == 'select',
                                        'partials.dash.question.select',
                                        [['question' => $question]]
                                    )
                                    @includeWhen(
                                        $question->typeInput->name == 'date',
                                        'partials.dash.question.date',
                                        ['question' => $question]
                                    )
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="tab-pane text-left fade" id="vert-tabs-feedBack" role="tabpanel"
                aria-labelledby="vert-tabs-feedBack-tab">
                @foreach ($feedBackQuestions as $question)
                    <div class="question-card card" id="question-card-{{ $question->id }}"
                        data-question="{{ json_encode($question) }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    @includeWhen(
                                        $question->typeInput->name == 'text',
                                        'partials.dash.question.text',
                                        ['question' => $question]
                                    )
                                    @includeWhen(
                                        $question->typeInput->name == 'radio',
                                        'partials.dash.question.radio',
                                        ['question' => $question]
                                    )
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-4" id="option_input">
    </div>

    <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure delete this question?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="question_id">Question Title</label>
                        <textarea class="form-control" id="question_title" disabled></textarea>
                    </div>
                </div>
                <form action="{{ route('question.delete') }}" method="POST">
                    @csrf
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="question_id">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>

        </div>

    </div> --}}
