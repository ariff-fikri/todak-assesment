@extends('layout.app')

@section('header')
    <div class="container-fluid page__heading-container">
        @if (auth()->user()->role == 'restaurant_manager')
            <div class="page__heading d-flex align-items-center justify-content-between">
                <h1 class="m-0">Orders</h1>
            </div>
        @elseif (auth()->user()->role == 'admin')
            <div class="page__heading d-flex align-items-center justify-content-between">
                <h1 class="m-0">Dashboard</h1>
            </div>
        @else
            <div class="page__heading d-flex align-items-center justify-content-between">
                <h1 class="m-0">Restaurants</h1>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endsection

@section('content')
    <div class="container-fluid page__container">

        @if (auth()->user()->role == 'restaurant_manager')
            <div class="row">
                @forelse ($orders as $order)
                    <div class="col-md-3">
                        <div class="card card__course">
                            <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="">
                                    <span class="course__title">{{ $order->menu->name ?? '' }}</span>
                                    <span class="course__subtitle">{{ $order->user->name ?? '' }}</span>
                                </a>
                            </div>
                            <div class="p-3">
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('restaurant.finishOrder', $order->id) }}" class="btn btn-primary mr-2">Finish Order <i class="fa fa-arrow-right"></i></a>
                                    <a href="{{ route('restaurant.rejectOrder', $order->id) }}" class="btn btn-danger">Reject Order <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    No Orders
                @endforelse
            </div>
        @elseif (auth()->user()->role == 'admin')
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Restaurants</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $restaurants->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-utensils fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Orders</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders->count() }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Users
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $users->count() }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Income</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">RM {{ number_format($orders->where('status', true)->sum('total_price'), 2, '.', ',') }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Total Orders</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> Rejected
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Finished
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-info"></i> Pending
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Restaurants Approval</h1>
            </div>
            <div class="card-header card-header-tabs-basic nav" role="tablist">
                <a href="#pending" class="@once active @endonce" data-toggle="tab" role="tab" aria-controls="approved" aria-selected="true">Pending</a>
                <a href="#approved" class="" data-toggle="tab" role="tab" aria-controls="approved" aria-selected="true">Approved</a>
            </div>
            <div class="card-body tab-content">
                <div class="tab-pane active show fade" id="pending">
                    <div class="row">
                        @forelse ($restaurants->where('status', false) as $restaurant)
                            <div class="col-md-3">
                                <div class="card card__course">
                                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="">
                                            <span class="course__title">{{ $restaurant->name ?? '' }}</span>
                                        </a>
                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('restaurant.approved', $restaurant->id) }}" class="btn btn-primary ml-auto">Approve Restaurant <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            No restaurants
                        @endforelse
                    </div>
                </div>
                <div class="tab-pane" id="approved">
                    <div class="row">
                        @forelse ($restaurants->where('status', true) as $restaurant)
                            <div class="col-md-3">
                                <div class="card card__course">
                                    <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                        <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="">
                                            <span class="course__title">{{ $restaurant->name ?? '' }}</span>
                                        </a>
                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('restaurant.ban', $restaurant->id) }}" class="btn btn-danger ml-auto">Ban Restaurant <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            No restaurants
                        @endforelse
                    </div>
                </div>
            </div> 
        @else
            <div class="card-header card-header-tabs-basic nav" role="tablist">
                @foreach ($categories as $category)
                    <a href="#category-{{ $category->id }}" class="@once active @endonce" data-toggle="tab" role="tab" aria-controls="form_4" aria-selected="true">{{ $category->name }}</a>
                @endforeach
            </div>
            <div class="card-body tab-content">
                @foreach ($categories as $category)
                    <div class="tab-pane @once active show fade @endonce" id="category-{{ $category->id }}">
                        <div class="row">
                            @forelse ($restaurants->where('category_id', $category->id) as $restaurant)
                                <div class="col-md-3">
                                    <div class="card card__course">
                                        <div class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                            <a class="card-header__title  justify-content-center align-self-center d-flex flex-column" href="">
                                                <span class="course__title">{{ $restaurant->name ?? '' }}</span>
                                            </a>
                                        </div>
                                        <div class="p-3">
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('restaurant.show', $restaurant->id) }}" class="btn btn-primary ml-auto">Show Menu <i class="fa fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                No restaurants
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div> 
        @endif

        
        <hr>

    </div>
@endsection

@push('js')
    <script>
       // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        var ordersFinished = @json($orders->where('status', 'finish')->count());
        var ordersPending = @json($orders->where('status', 'in_kitchen')->count());
        var ordersRejected = @json($orders->where('status', 'reject')->count());

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Pending", "Finished", "Rejected"],
                datasets: [{
                data: [ordersPending, ordersFinished, ordersRejected],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                },
                legend: {
                display: false
                },
                cutoutPercentage: 80,
            },
        });

        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
            label: "Earnings",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: @json($totalPricesByMonth),
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
            xAxes: [{
                time: {
                unit: 'date'
                },
                gridLines: {
                display: false,
                drawBorder: false
                },
                ticks: {
                maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                    return '$' + number_format(value);
                }
                },
                gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
                }
            }],
            },
            legend: {
            display: false
            },
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                }
            }
            }
        }
    });
    </script>
@endpush