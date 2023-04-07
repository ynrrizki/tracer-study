@extends('layouts.dash')

@section('content')
    @include('partials.dash.total-alumni', [
        'currently_filling' => $currently_filling,
        'finished_filling' => $finished_filling,
    ])
    <div class="row">
        {{-- <div class="col-xl-8 col-lg-7"> --}}
        {{-- <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Alumni yang mengisi</h4>
                </div>
                <div class="card-body">
                    <div id="lineChart"></div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-xl-4 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Status Alumni</h4>
                </div>
                <div class="card-body">
                    <div id="donutChart"></div>
                </div>
            </div>
        </div> --}}
    </div>
    @foreach ($questions as $question)
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $question->name }} <b>(Alumni)</b></h4>
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
                    <div class="card-body">
                        <div id="{{ 'chart' . $question->id }}"></div>
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
                            height: 400,
                            type: 'bar',
                            toolbar: {
                                show: false
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                barHeight: '30%',
                                startingShape: 'rounded',
                                borderRadius: 8,
                                name: {
                                    fontSize: '2rem',
                                    fontFamily: 'Open Sans'
                                },
                                value: {
                                    fontSize: '1.2rem',
                                    fontFamily: 'Open Sans',
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
        </script>
        <script>
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
            const donutChartEl = document.querySelector('#donutChart'),
                donutChartConfig = {
                    chart: {
                        height: 390,
                        type: 'donut'
                    },
                    labels: ['Bekerja', 'Kuliah', 'Wirausaha'],
                    series: [3, 1, 1],
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
                    stroke: {
                        show: false,
                        curve: 'straight'
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val, opt) {
                            return parseInt(val, 10) + '%';
                        }
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
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
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    name: {
                                        fontSize: '2rem',
                                        fontFamily: 'Open Sans'
                                    },
                                    value: {
                                        fontSize: '1.2rem',
                                        // color: '#4e73df',
                                        fontFamily: 'Open Sans',
                                        formatter: function(val) {
                                            return parseInt(val, 10) + '%';
                                        }
                                    },
                                    total: {
                                        show: true,
                                        fontSize: '1.5rem',
                                        // color: '#4e73df',
                                        label: 'Operational',
                                        formatter: function(w) {
                                            return '31%';
                                        }
                                    }
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
        </script>
        <script>
            // let cardColor, headingColor, axisColor, shadeColor, borderColor, labelColor;

            // cardColor = config.colors.white;
            // headingColor = config.colors.headingColor;
            // axisColor = config.colors.axisColor;
            // borderColor = config.colors.borderColor;
            // labelColor = config.colors.labelColor;

            const lineChartEl = document.querySelector('#lineChart'),
                lineChartConfig = {
                    chart: {
                        height: 400,
                        type: 'line',
                        parentHeightOffset: 0,
                        zoom: {
                            enabled: true
                        },
                        toolbar: {
                            show: false
                        }
                    },
                    series: [{
                        data: [280, 200, 220, 180, 270, 250, 70, 90, 200, 150, 160, 100, 150, 100, 50]
                    }],
                    markers: {
                        strokeWidth: 7,
                        strokeOpacity: 1,
                        strokeColors: [config.colors.white],
                        colors: [config.colors.warning]
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    colors: [config.colors.warning],
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
                            return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + '%</span>' +
                                '</div>';
                        }
                    },
                    xaxis: {
                        categories: [
                            '7/12',
                            '8/12',
                            '9/12',
                            '10/12',
                            '11/12',
                            '12/12',
                            '13/12',
                            '14/12',
                            '15/12',
                            '16/12',
                            '17/12',
                            '18/12',
                            '19/12',
                            '20/12',
                            '21/12'
                        ],
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
            if (typeof lineChartEl !== undefined && lineChartEl !== null) {
                const lineChart = new ApexCharts(lineChartEl, lineChartConfig);
                lineChart.render();
            }
        </script>
        <script>
            // const horizontalBarChartEl = document.querySelector('#horizontalBarChart'),
            //     statusData = [2, 1, 1],
            //     totalStudents = statusData.reduce((total, current) => total + current),
            //     percentageData = statusData.map(value => Math.round(value / totalStudents * 100) + '% (' + value + ')'),
            //     horizontalBarChartConfig = {
            //         chart: {
            //             height: 400,
            //             type: 'bar',
            //             toolbar: {
            //                 show: false
            //             }
            //         },
            //         plotOptions: {
            //             bar: {
            //                 horizontal: true,
            //                 barHeight: '30%',
            //                 startingShape: 'rounded',
            //                 borderRadius: 8,
            //                 name: {
            //                     fontSize: '2rem',
            //                     fontFamily: 'Open Sans'
            //                 },
            //                 value: {
            //                     fontSize: '1.2rem',
            //                     fontFamily: 'Open Sans',
            //                     formatter: function(val, opts) {
            //                         let total = opts.seriesTotals.reduce((a, b) => a + b, 0);
            //                         let percent = ((val / total) * 100).toFixed(0) + '%';
            //                         return percent;
            //                     }
            //                 },
            //             }
            //         },
            //         grid: {
            //             borderColor: borderColor,
            //             xaxis: {
            //                 lines: {
            //                     show: false
            //                 }
            //             },
            //             padding: {
            //                 top: -20,
            //                 bottom: -12
            //             }
            //         },
            //         colors: config.colors.warning,
            //         dataLabels: {
            //             enabled: true,
            //             formatter: function(val, opt) {
            //                 const data = percentageData[opt.dataPointIndex];
            //                 return data;
            //             }
            //         },
            //         series: [{
            //             data: statusData,
            //         }],
            //         xaxis: {
            //             categories: ['Bekerja', 'Kuliah', 'Wirausaha'],
            //             axisBorder: {
            //                 show: false
            //             },
            //             axisTicks: {
            //                 show: false
            //             },
            //             labels: {
            //                 style: {
            //                     colors: labelColor,
            //                     fontSize: '13px'
            //                 }
            //             }
            //         },
            //         yaxis: {
            //             labels: {
            //                 style: {
            //                     colors: labelColor,
            //                     fontSize: '13px'
            //                 }
            //             }
            //         }
            //     };

            // if (typeof horizontalBarChartEl !== undefined && horizontalBarChartEl !== null) {
            //     const horizontalBarChart = new ApexCharts(horizontalBarChartEl, horizontalBarChartConfig);
            //     horizontalBarChart.render();
            // }
        </script>
    @endpush
@endsection
