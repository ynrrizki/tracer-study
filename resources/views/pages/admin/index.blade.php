@extends('layouts.dash')

@section('content')
    @include('partials.dash.total-alumni', [
        'currently_filling' => $currently_filling,
        'finished_filling' => $finished_filling,
        'survey_question' => $survey_question,
        'feedback_question' => $feedback_question,
    ])
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="d-flex" action="{{ route('admin') }}">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search..."
                                aria-describedby="basic-addon-search31" name="search_grade_at"
                                value="{{ request('search_grade_at') }}">
                        </div>
                        <div class="mx-2"></div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    @foreach ($questions as $question)
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title">
                            <h4>{{ $question->name }} <b>(Alumni)</b></h4>
                            @php
                                $count = 0;
                                foreach ($question->answers as $answer) {
                                    if ($question->id == $answer->question_id) {
                                        $count = $question->answers->count();
                                    }
                                }
                            @endphp
                            <p class="card-sub-title">Jawaban Dari {{ $count }} Anak</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-md-8">
                                <div id="{{ 'chart' . $question->id }}"></div>
                            </div>
                            <div class="col-md-4">
                                <div id="donutChart{{ $question->id }}"></div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="accordion" id="accordionExample">
                                <div class="card shadow-none accordion-item border border-secondary">
                                    <h2 class="accordion-header" id="headingID{{ $question->id }}">
                                        <button type="button"
                                            class="accordion-button collapsed pt-4 pb-4 align-items-center"
                                            data-bs-toggle="collapse" data-bs-target="#accordionID{{ $question->id }}"
                                            aria-expanded="false" aria-controls="accordionID{{ $question->id }}">
                                            <h5 class="m-0">Tampilkan Data Statistik Per-Angkatan</h5>
                                        </button>
                                    </h2>
                                    <div id="accordionID{{ $question->id }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @foreach ($question->optionInputs as $optionInput)
                                                <hr>
                                                <div class="row mb-5">
                                                    <div class="card-header">
                                                        <h4 class="card-title">
                                                            <b>{{ $optionInput->name }}</b>
                                                        </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div id="lineChart{{ $optionInput->id }}"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('addon-js')
        <script>
            @foreach ($questions as $question)
                @php
                    $categories = [];
                    $data = [];
                    $alumni = count($question->answers);
                    foreach ($question->optionInputs as $optionInput) {
                        $categories[] = $optionInput->name;
                    
                        foreach ($question->answers as $answer) {
                            if ($optionInput->question_id == $answer->question_id) {
                                $data[] = count($question->answers);
                                if (count($question->answers) > count($data)) {
                                    $data[] += 0;
                                }
                            }
                        }
                    }
                    
                    // dd($data);
                    $categories = [];
                    $data = [];
                    
                    foreach ($question->optionInputs as $optionInput) {
                        // optionInput 1:
                        // Bekerja
                        // Kuliah
                        // Wirausaha
                        // optionInput 2:
                        // Sesuai
                        // Tidak Sesuai
                        $categories[] = $optionInput->name;
                    }
                    
                    foreach ($categories as $category) {
                        $optionData = 0;
                    
                        foreach ($question->answers as $answer) {
                            // answer 1 in optionInputs 1:
                            // Bekerja -> nilainya 1
                            // answer 2 in optionInputs 1:
                            // Kuliah -> nilainya 1
                            // answer 3 in optionINputs 1:
                            // null -> nilainya 0
                            // answer 4 in optionInputs 2:
                            // Sesuai -> nilainya 1
                            // answer 5 in optionInputs 2:
                            // Tidak Sesuai -> nilainya 1
                            // output seharusnya
                            // $data answer 1 sampai 3
                            // $data = [1, 1, 0]
                            // $data answer 4 sampai 5
                            // $data = [1, 1]
                            if ($answer->fill === $category) {
                                $optionData += isset($answer->fill) ? 1 : 0;
                            }
                        }
                    
                        $data[] = $optionData;
                    }
                @endphp

                percentageBarChart('chart{{ $question->id }}', {!! json_encode($data) !!}, {!! json_encode($categories) !!});
                percentageDonutChart('donutChart{{ $question->id }}', {!! json_encode($data) !!}, {!! json_encode($categories) !!},
                    {{ $alumni }});
                @foreach ($question->optionInputs as $optionInput)
                    @php
                        $dataLine = [];
                        foreach ($range_grade_at as $year) {
                            $optionData = 0;
                            foreach ($question->answers as $answer) {
                                if ($answer->user->grade_at === $year && $answer->fill === $optionInput->name) {
                                    $optionData += isset($answer->fill) ? 1 : 0;
                                }
                            }
                            $dataLine[] = $optionData;
                        }
                    @endphp
                    console.log({!! json_encode($dataLine) !!});
                    percentageLineChart('lineChart{{ $optionInput->id }}', {!! json_encode($dataLine) !!}, {!! json_encode($range_grade_at) !!})
                @endforeach
            @endforeach

            function percentageBarChart(id = '', dataSet = [], categories = []) {
                let cardColor, headingColor, axisColor, shadeColor, borderColor, labelColor;

                cardColor = config.colors.white;
                headingColor = config.colors.headingColor;
                axisColor = config.colors.axisColor;
                borderColor = config.colors.borderColor;
                labelColor = config.colors.labelColor;
                const horizontalBarChartEl = document.querySelector('#' + id),
                    data = dataSet,
                    totalStudents = dataSet.reduce((total, current) => total + current),
                    percentageData = dataSet.map(value => Math.round(value / totalStudents * 100) + '% (' + value + ')'),
                    horizontalBarChartConfig = {
                        chart: {
                            height: 450,
                            type: 'bar',
                            toolbar: {
                                show: false
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                barHeight: '35%',
                                startingShape: 'rounded',
                                borderRadius: 8,
                                name: {
                                    fontSize: '2rem',
                                    fontFamily: 'Public Sans'
                                },
                                value: {
                                    fontSize: '1.2rem',
                                    fontFamily: 'Public Sans',
                                    formatter: function(val, opts) {
                                        let total = opts.seriesTotals.reduce((a, b) => a + b, 0);
                                        let percent = ((val / total) * 100).toFixed(0) + '%';
                                        return percent;
                                    }
                                },
                            }
                        },
                        grid: {
                            borderColor: borderColor,
                            xaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                                top: -20,
                                bottom: -12
                            }
                        },
                        colors: config.colors.warning,
                        dataLabels: {
                            enabled: true,
                            formatter: function(val, opt) {
                                const data = percentageData[opt.dataPointIndex];
                                return data;
                            }
                        },
                        series: [{
                            data: data,
                        }],
                        xaxis: {
                            categories: categories,
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            labels: {
                                style: {
                                    colors: labelColor,
                                    fontSize: '13px'
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: labelColor,
                                    fontSize: '13px'
                                }
                            }
                        }
                    };

                if (typeof horizontalBarChartEl !== undefined && horizontalBarChartEl !== null) {
                    const horizontalBarChart = new ApexCharts(horizontalBarChartEl, horizontalBarChartConfig);
                    horizontalBarChart.render();
                }
            }

            function percentageDonutChart(id = '', data, categories, total) {
                let cardColor, headingColor, axisColor, shadeColor, borderColor, labelColor;

                cardColor = config.colors.white;
                headingColor = config.colors.headingColor;
                axisColor = config.colors.axisColor;
                borderColor = config.colors.borderColor;
                labelColor = config.colors.labelColor;
                // chartColors.donut.series1 = 'blue';
                // chartColors.donut.series4 = 'orange';
                // chartColors.donut.series3 = 'black';
                // chartColors.donut.series2 = 'red';
                const donutChartEl = document.querySelector('#' + id),
                    donutChartConfig = {
                        chart: {
                            // height: 165,
                            // width: 130,
                            // type: 'donut'
                            height: 390,
                            // width: 130,
                            type: 'donut'
                        },
                        // labels: ['Bekerja', 'Kuliah', 'Wirausaha'],
                        labels: categories,
                        // series: [3, 1, 1],
                        colors: [config.colors.primary, config.colors.secondary, config.colors.info, config.colors.success],
                        series: data,
                        stroke: {
                            width: 5,
                            colors: cardColor
                        },
                        // colors: [
                        //     '#4e73df',
                        //     '#6610f2',
                        //     '#e74a3',
                        //     '#f6c23e',
                        //     //     chartColors.donut.series1,
                        //     //     chartColors.donut.series4,
                        //     //     chartColors.donut.series3,
                        //     //     chartColors.donut.series2
                        // ],
                        dataLabels: {
                            enabled: true,
                            formatter: function(val, opt) {
                                return parseInt(val, 10) + '%';
                            }
                        },
                        legend: {
                            show: false,
                            position: 'top',
                            markers: {
                                offsetX: -3
                            },
                            itemMargin: {
                                vertical: 3,
                                horizontal: 10
                            },
                            labels: {
                                // colors: '#4e73df',
                                useSeriesColors: false
                            }
                        },
                        grid: {
                            padding: {
                                top: 0,
                                bottom: 0,
                                right: 15
                            }
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '75%',
                                    labels: {
                                        show: true,
                                        name: {
                                            // fontSize: '1.5rem',
                                            offsetY: 20,
                                            fontFamily: 'Public Sans'
                                        },
                                        value: {
                                            fontSize: '3rem',
                                            fontFamily: 'Public Sans',
                                            color: headingColor,
                                            offsetY: -25,
                                            formatter: function(val) {
                                                return parseInt(val);
                                            }
                                        },
                                        // value: {
                                        //     fontSize: '1.2rem',
                                        //     // color: '#4e73df',
                                        //     // fontFamily: 'Open Sans',
                                        //     formatter: function(val) {
                                        //         // return parseInt(val, 10) + '%';
                                        //         return val + ' Orang';
                                        //     }
                                        // },
                                        total: {
                                            show: true,
                                            fontSize: '2rem',
                                            color: axisColor,
                                            label: 'Orang',
                                            formatter: function(w) {
                                                // return '38%';
                                                return total;
                                            }
                                        }
                                        // total: {
                                        //     show: true,
                                        //     fontSize: '1.5rem',
                                        //     // color: '#4e73df',
                                        //     label: 'Total',
                                        //     formatter: function(w) {
                                        //         // return '31%';
                                        //         return total + ' Orang';
                                        //     }
                                        // }
                                    }
                                }
                            }
                        },
                        responsive: [{
                                breakpoint: 992,
                                options: {
                                    chart: {
                                        height: 380
                                    },
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            // colors: '#4e73df',
                                            useSeriesColors: false
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 576,
                                options: {
                                    chart: {
                                        height: 320
                                    },
                                    plotOptions: {
                                        pie: {
                                            donut: {
                                                labels: {
                                                    show: true,
                                                    name: {
                                                        fontSize: '1.5rem'
                                                    },
                                                    value: {
                                                        fontSize: '1rem'
                                                    },
                                                    total: {
                                                        fontSize: '1.5rem'
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            // colors: '#4e73df',
                                            useSeriesColors: false
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 420,
                                options: {
                                    chart: {
                                        height: 280
                                    },
                                    legend: {
                                        show: false
                                    }
                                }
                            },
                            {
                                breakpoint: 360,
                                options: {
                                    chart: {
                                        height: 250
                                    },
                                    legend: {
                                        show: false
                                    }
                                }
                            }
                        ]
                    };
                if (typeof donutChartEl !== undefined && donutChartEl !== null) {
                    const donutChart = new ApexCharts(donutChartEl, donutChartConfig);
                    donutChart.render();
                }
            }

            function percentageLineChart(id = '', data = [], categories = []) {
                let cardColor, headingColor, axisColor, shadeColor, borderColor, labelColor;

                cardColor = config.colors.white;
                headingColor = config.colors.headingColor;
                axisColor = config.colors.axisColor;
                borderColor = config.colors.borderColor;
                labelColor = config.colors.labelColor;

                const lineChartEl = document.querySelector('#' + id),
                    lineChartConfig = {
                        chart: {
                            height: 400,
                            type: 'area',
                            parentHeightOffset: 0,
                            parentWidthOffset: 0,
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        series: [{
                            data: data,
                        }],
                        markers: {
                            size: 6,
                            colors: 'transparent',
                            strokeColors: 'transparent',
                            strokeWidth: 4,
                            discrete: [{
                                fillColor: config.colors.white,
                                seriesIndex: 0,
                                dataPointIndex: 7,
                                strokeColor: config.colors.primary,
                                strokeWidth: 2,
                                size: 6,
                                radius: 8
                            }],
                            hover: {
                                size: 7
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            // width: 2,
                            curve: 'smooth'
                        },
                        legend: {
                            show: false,
                        },
                        colors: [config.colors.warning],
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: shadeColor,
                                shadeIntensity: 0.6,
                                opacityFrom: 0.5,
                                opacityTo: 0.25,
                                stops: [0, 95, 100]
                            }
                        },
                        grid: {
                            borderColor: borderColor,
                            xaxis: {
                                lines: {
                                    show: true
                                }
                            },
                            padding: {
                                top: -20
                            }
                        },
                        tooltip: {
                            custom: function({
                                series,
                                seriesIndex,
                                dataPointIndex,
                                w
                            }) {
                                return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] +
                                    '</span>' +
                                    '</div>';
                            }
                        },
                        xaxis: {
                            categories: categories,
                            // categories: [
                            //     '2015',
                            //     '2016',
                            //     '2017',
                            //     '2018',
                            //     '2019',
                            //     '2020',
                            //     '2021',
                            //     '2022',
                            //     '2023',
                            // ],
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            labels: {
                                show: true,
                                style: {
                                    fontSize: '13px',
                                    colors: axisColor
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: labelColor,
                                    fontSize: '13px'
                                }
                            }
                        }
                    };
                if (typeof lineChartEl !== undefined && lineChartEl !== null) {
                    const lineChart = new ApexCharts(lineChartEl, lineChartConfig);
                    lineChart.render();
                }
            }
        </script>
    @endpush
@endsection
