@extends('layouts.base')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="">{{show_money($total_revenue)}}</span></h4>
                            <p class="text-muted mb-0">Total Revenue</p>
                        </div>
{{--                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>2.65%</span> since last week--}}
                        </p>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="orders-chart" data-colors='["--bs-success"]'> </div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$order->count()}}</span></h4>
                            <p class="text-muted mb-0">Orders</p>
                        </div>
{{--                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>0.82%</span> since last week--}}
                        </p>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end mt-2">
                            <div id="customers-chart" data-colors='["--bs-primary"]'> </div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$count_customer}}</span></h4>
                            <p class="text-muted mb-0">Customers</p>
                        </div>
{{--                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>6.24%</span> since last week--}}
                        </p>
                    </div>
                </div>
            </div> <!-- end col-->

{{--            <div class="col-md-6 col-xl-3">--}}

{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="float-end mt-2">--}}
{{--                            <div id="growth-chart" data-colors='["--bs-warning"]'></div>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h4 class="mb-1 mt-1">+ <span data-plugin="counterup">12.58</span>%</h4>--}}
{{--                            <p class="text-muted mb-0">Growth</p>--}}
{{--                        </div>--}}
{{--                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>10.51%</span> since last week--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div> <!-- end col-->--}}
        </div> <!-- end row-->

        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <div class="dropdown">
                                <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5"
                                   data-bs-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <span class="fw-semibold">Sort By:</span> <span class="text-muted analytics-type">Day<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                    <a class="dropdown-item" href="#" onclick="sale_analytics('Day')">Day</a>
                                    <a class="dropdown-item" href="#" onclick="sale_analytics('Monthly')">Monthly</a>
                                    <a class="dropdown-item" href="#" onclick="sale_analytics('Weekly')">Weekly</a>
                                </div>
                            </div>
                        </div>
                        <h4 class="card-title mb-4">Sales Analytics</h4>

                        <div class="mt-1">
                            <ul class="list-inline main-chart mb-0">
{{--                                <li class="list-inline-item chart-border-left me-0 border-0">--}}
{{--                                    <h3 class="text-primary">$<span data-plugin="counterup">2,371</span><span class="text-muted d-inline-block font-size-15 ms-3">Income</span></h3>--}}
{{--                                </li>--}}
{{--                                <li class="list-inline-item chart-border-left me-0">--}}
{{--                                    <h3><span data-plugin="counterup">258</span><span class="text-muted d-inline-block font-size-15 ms-3">Sales</span>--}}
{{--                                    </h3>--}}
{{--                                </li>--}}
{{--                                <li class="list-inline-item chart-border-left me-0">--}}
{{--                                    <h3><span data-plugin="counterup">3.6</span>%<span class="text-muted d-inline-block font-size-15 ms-3">Conversation Ratio</span></h3>--}}
{{--                                </li>--}}
                            </ul>
                        </div>

                        <div class="mt-3">
                            <div id="sales-analytics-chart" data-colors='["--bs-primary", "#dfe2e6", "--bs-warning"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <div class="dropdown">
{{--                                <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton1"--}}
{{--                                   data-bs-toggle="dropdown" aria-haspopup="true"--}}
{{--                                   aria-expanded="false">--}}
{{--                                    <span class="fw-semibold">Sort By:</span> <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">--}}
{{--                                    <a class="dropdown-item" href="#">Monthly</a>--}}
{{--                                    <a class="dropdown-item" href="#">Yearly</a>--}}
{{--                                    <a class="dropdown-item" href="#">Weekly</a>--}}
{{--                                </div>--}}
                            </div>
                        </div>

                        <h4 class="card-title" style="    margin-bottom: 42px;">Top Selling Products</h4>

{{--                        @dd($order_item,$round_up)--}}
                        @foreach($order_item as $item)
                            <div class="row align-items-center g-0 mt-3">
                                <div class="col-sm-3">
                                    <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i> {{$item['name']}} </p>
                                </div>

                                <div class="col-sm-8">
                                    <div class="progress mt-1" style="height: 6px;">
                                        <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                             style="width: {{$item['count'] / $round_up *100}}%" aria-valuenow="52" aria-valuemin="0"
                                             aria-valuemax="52">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1 text-end">
                                    {{$item['count']}}
                                </div>
                            </div> <!-- end row-->
                        @endforeach


                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end Col -->
        </div> <!-- end row-->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
{{--                            <div class="dropdown">--}}
{{--                                <a class=" dropdown-toggle" href="#" id="dropdownMenuButton2"--}}
{{--                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    <span class="text-muted">All Members<i class="mdi mdi-chevron-down ms-1"></i></span>--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">--}}
{{--                                    <a class="dropdown-item" href="#">Locations</a>--}}
{{--                                    <a class="dropdown-item" href="#">Revenue</a>--}}
{{--                                    <a class="dropdown-item" href="#">Join Date</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <h4 class="card-title mb-4">Top Users</h4>
                        <div data-simplebar style="max-height: 339px;">
                            <div class="table-responsive">
                                <table class="table table-borderless table-centered table-nowrap">
                                    <tbody>
                                    @foreach($rank as $k => $value)
                                        <tr>
                                            <td>
                                                <h6 class="font-size-15 mb-1 fw-normal">{{$customer_rank[$k]->name}}</h6>
                                                <p class="text-muted font-size-13 mb-0"><i class="mdi mdi-map-marker"></i> {{$customer_rank[$k]->address}}</p>
                                            </td>
{{--                                            <td><span class="badge bg-soft-danger font-size-12">Cancel</span></td>--}}
                                            <td class="text-muted fw-semibold text-end"><i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i>{{show_money($value)}}</td>
                                        </tr>
                                      @endforeach


                                    </tbody>
                                </table>
                            </div> <!-- enbd table-responsive-->
                        </div> <!-- data-sidebar-->
                    </div><!-- end card-body-->
                </div> <!-- end card-->
            </div><!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" id="dropdownMenuButton3"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted">Recent<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton3">
                                    <a class="dropdown-item" href="#">Recent</a>
                                    <a class="dropdown-item" href="#">By Users</a>
                                </div>
                            </div>
                        </div>

                        <h4 class="card-title mb-4">Recent Activity</h4>

                        <ol class="activity-feed mb-0 ps-2" data-simplebar style="max-height: 339px;">
                            @foreach($log as $k => $item)
                                <li class="feed-item">
                                    <div class="feed-item-list">
                                        <p class="text-muted mb-1 font-size-13"><small class="d-inline-block ms-1">{{$item->created_at}}</small></p>
                                        <p class="mb-0">Tài khoản {{$item->created_by->email}} đã {{@$item->type['name']}} bản ghi số  {{$item->id}} của bảng {{$item->table}}
                                        </p>
                                    </div>
                                </li>
                            @endforeach


                        </ol>

                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->



    </div> <!-- container-fluid -->

@endsection
@section('JS')
    <script src="{{url('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

{{--    <script src="{{url('assets/js/pages/dashboard.init.js')}}"></script>--}}




    <!-- apexcharts -->

    <script>

        var data_order = []
        var income = []
        var labels = []

        function sale_analytics(type){
            console.log(type)
            $.ajax({
                url: "/admin/analytics",
                dataType: 'json',
                data: {'type': type},
            })
                .done(function(res) {
                    document.querySelector('.analytics-type').innerHTML = type
                    data_order = res.data_order
                    income = res.income
                    labels = res.labels
                    load_option(data_order,income,labels)
                })
        }


        var options, chart, LinechartsalesColors = getChartColorsArray("sales-analytics-chart");
        LinechartsalesColors && (options = {
            chart: {height: 343, type: "line", stacked: !1,
                toolbar: {
                    show: true,
                    tools: {
                        download: false,
                        selection: false,
                        zoom: false,
                        zoomin: true,
                        zoomout: true,
                        pan: false,
                        reset: false,
                        customIcons: []
                    }
                }
            },
            stroke: {width: [0, 2, 4], curve: "smooth"},
            plotOptions: {bar: {columnWidth: "30%"}},
            colors: LinechartsalesColors,
            series:
                [
                    {
                        name: "Order",
                        type: "column",
                        data: data_order
                    },
                    {
                        name: "Income",
                        type: "area",
                        data: income
                    },
                ],
            fill: {
                opacity: [.85, .25, 1],
                gradient: {
                    inverseColors: !1,
                    shade: "light",
                    type: "vertical",
                    opacityFrom: .85,
                    opacityTo: .55,
                    stops: [0, 100, 100, 100]
                }
            },
            labels: labels,
            markers: {size: 0},
            // xaxis: {type: "datetime"},
            yaxis: [{ // y-axis cho cột và area
                opposite: true,
                title: {
                    // Hiển thị ở phía bên phải
                    text: "Sales",
                    seriesName : "Order"
                }
            },
                { // y-axis cho cột và area
                    opposite: false,
                    title: {
                        // Hiển thị ở phía bên phải
                        text: "Income",
                        seriesName : "Income"
                    }
                }
            ],

            tooltip:
                {
                    y: {
                        formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                            if(value > 1000){
                                return value +' vnđ'
                            }
                            else{
                                return value +' đơn'
                            }

                        }
                    }
                }
            ,
            grid: {borderColor: "#f1f1f1"}
        });
        var  a = new ApexCharts(document.querySelector("#sales-analytics-chart"), options)
        a.render()
        function load_option(data_order,income,labels) {
            a.updateSeries([
                {
                    name: "Order",
                    type: "column",
                    data: data_order
                },
                {
                    name: "Income",
                    type: "area",
                    data: income
                },
                ])
            a.updateOptions({
                xaxis: {
                    categories: labels
                }
            });
        }

        sale_analytics('Day')
    </script>
@endsection