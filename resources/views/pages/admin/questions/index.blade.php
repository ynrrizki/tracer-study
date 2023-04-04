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
    @endpush

    <div class="col-md-3">
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

    </div>


    @push('addon-js')
        <script></script>
        <script>
            $(document).ready(function() {
                // Ketika nav di klik
                $('.nav-link').click(function() {
                    // Ambil ID nav yang di klik
                    let navID = $(this).attr('id');
                    let categoryID = 4;
                    switch (navID) {
                        case 'vert-tabs-survey-tab':
                            categoryID = 4;
                            break;
                        case 'vert-tabs-feedBack-tab':
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
                    if (!$(this).hasClass('card-primary') && !$(this).hasClass('card-outline')) {
                        let data = JSON.parse($(this).attr('data-question'));
                        activeCard(this, data);
                        let button = `<div class="form-group mb-5 question-card-button">
                        <button type="button" class="btn btn-warning question-card-cancel" onclick="questionCardButton('cancel', {{ $questionId }})">Cancel</button>
                        <button class="btn btn-danger open-modal" data-toggle="modal" data-target="#modal-default" onclick="questionCardButton('delete', ${JSON.stringify(data).replace(/"/g, '&quot;')})">Delete</button>
                        </div>`;
                        $(button).hide().insertAfter(this).fadeIn('slow');
                    } else {
                        unActiveCard();
                    }
                });
            @endforeach


            @foreach ($feedBackQuestions as $question)
                @php
                    $questionId = $question->id;
                @endphp
                $(document).on('click', '#question-card-{{ $questionId }}', function() {
                    if (!$(this).hasClass('card-primary') && !$(this).hasClass('card-outline')) {
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
                });
            @endforeach

            $(".type-input").change(function() {
                let form = `<form action="{{ route('optionInput.save') }}" method="POST" id="form-add-option">
                @csrf
                <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Add Option
                    </div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <input type="hidden" id="questionId" name="question_id">
                    <div class="option-input-card card-body">
                        <div class="form-group">
                            <label for="inputOption">Option</label>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="form-group mb-5">
                <button type="reset" class="btn btn-warning">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
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
            $(document).on('click', '.card-tools button', function() {
                appendOptionInput()
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

            function appendOptionInput() {
                $('.option-input-card').append(fieldOptionInput());
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
                                <button type="submit" class="btn btn-danger" id="deleteButton"><i class="fas fa-trash"></i></button>
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
                                <button type="submit" class="btn btn-danger" id="deleteButton-${data.id}"><i class="fas fa-trash"></i></button>
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
                $('.question-card').removeClass('card-primary card-outline');
                $('.question-card-button').remove();
                $('#id').val("");
                $('#inputQuestionTitle').val("");
                $('#inputQuestionTypeInput').val("").change();
            }

            function isActiveCard(selector, data) {
                $(selector).addClass('card-primary card-outline');
                formQuestion(data);
                formAddOption(selector, data);
            }

            function formQuestion(data) {
                $('#id').val(data.id);
                $('#inputQuestionTitle').val(data.name);
                $('#inputQuestionTypeInput').val(data.type_input_id).change();
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
