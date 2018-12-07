@extends('layouts.master')

@section('title', '主控台')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            主控台
            <small>後台管理首頁</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 主控台</a></li>
            <li class="active">後台管理首頁</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row m-t-25">
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c1">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                            <div class="text">
                                <h2>{{\App\User::count()}}</h2>
                                <span>使用者总数</span>
                            </div>
                        </div>
                        <div class="overview-chart">
                            <canvas id="widgetChart1"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c2">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                            <div class="text">
                                <h2>{{$totalSaleProduct}}</h2>
                                <span>产品总销售量</span>
                            </div>
                        </div>
                        <div class="overview-chart">
                            <canvas id="widgetChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c3">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-calendar-note"></i>
                            </div>
                            <div class="text">
                                <h2>{{\App\Order::count()}}</h2>
                                <span>订单总数量</span>
                            </div>
                        </div>
                        <div class="overview-chart">
                            <canvas id="widgetChart3"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c4">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-money"></i>
                            </div>
                            <div class="text">
                                <h2>${{$totalSaleMoney}}</h2>
                                <span>total earnings</span>
                            </div>
                        </div>
                        <div class="overview-chart">
                            <canvas id="widgetChart4"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Orders</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>订单ID</th>
                            <th>商品地址</th>
                            <th>购买日期</th>
                            <th>付费状态</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0; $i< $maxShow; $i++)
                            <tr>
                                <td><a href="{{ route('orders.show', $orders[$i]->id) }}">{{$orders[$i]->id}}</a></td>
                                <td>{{$orders[$i]->address}}</td>
                                <td style="font-weight: bold; font-size: 110%;">{{$orders[$i]->created_at}}</td>
                                <td>
                                    @if(!$orders[$i]->is_check)
                                        <span class="label label-danger">Unpaid</span>
                                    @else
                                        <span class="label label-success">Paid</span>
                                    @endif
                                </td>

                            </tr>

                        @endfor
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="{{route('orders.index')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Main JS-->
<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script>
    //WidgetChart 1
    var ctx = document.getElementById("widgetChart1");
    if (ctx) {
        ctx.height = 130;
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'October', 'September', 'November', 'December'],
                type: 'line',
                datasets: [{
                    data: [
                        @foreach ($users_per_month as $user)
                        {{$user}},
                        @endforeach
                        ],
                    label: 'Incoming member',
                    backgroundColor: 'rgba(255,255,255,.1)',
                    borderColor: 'rgba(255,255,255,.55)',
                },]
            },
            options: {
                maintainAspectRatio: true,
                legend: {
                    display: false
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                responsive: true,
                scales: {
                    xAxes: [{
                        gridLines: {
                            color: 'transparent',
                            zeroLineColor: 'transparent'
                        },
                        ticks: {
                            fontSize: 2,
                            fontColor: 'transparent'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        ticks: {
                            display: false,
                        }
                    }]
                },
                title: {
                    display: false,
                },
                elements: {
                    line: {
                        borderWidth: 0
                    },
                    point: {
                        radius: 0,
                        hitRadius: 10,
                        hoverRadius: 4
                    }
                }
            }
        });
    }


    //WidgetChart 2
    var ctx = document.getElementById("widgetChart2");
    if (ctx) {
        ctx.height = 130;
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'October', 'September', 'November', 'December'],
                type: 'line',
                datasets: [{
                    data: [
                        @foreach ($sale_products_per_month as $user)
                        {{$user}},
                        @endforeach
                    ],
                    label: 'Product sales',
                    backgroundColor: 'transparent',
                    borderColor: 'rgba(255,255,255,.55)',
                },]
            },
            options: {

                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                responsive: true,
                tooltips: {
                    mode: 'index',
                    titleFontSize: 12,
                    titleFontColor: '#000',
                    bodyFontColor: '#000',
                    backgroundColor: '#fff',
                    titleFontFamily: 'Montserrat',
                    bodyFontFamily: 'Montserrat',
                    cornerRadius: 3,
                    intersect: false,
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            color: 'transparent',
                            zeroLineColor: 'transparent'
                        },
                        ticks: {
                            fontSize: 2,
                            fontColor: 'transparent'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        ticks: {
                            display: false,
                        }
                    }]
                },
                title: {
                    display: false,
                },
                elements: {
                    line: {
                        tension: 0.00001,
                        borderWidth: 1
                    },
                    point: {
                        radius: 4,
                        hitRadius: 10,
                        hoverRadius: 4
                    }
                }
            }
        });
    }


    //WidgetChart 3
    var ctx = document.getElementById("widgetChart3");
    if (ctx) {
        ctx.height = 130;
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'October', 'September', 'November', 'December'],
                type: 'line',
                datasets: [{
                    data: [
                        @foreach ($orders_per_month as $order)
                        {{$order}},
                        @endforeach
                    ],
                    label: 'Orders',
                    backgroundColor: 'transparent',
                    borderColor: 'rgba(255,255,255,.55)',
                },]
            },
            options: {

                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                responsive: true,
                tooltips: {
                    mode: 'index',
                    titleFontSize: 12,
                    titleFontColor: '#000',
                    bodyFontColor: '#000',
                    backgroundColor: '#fff',
                    titleFontFamily: 'Montserrat',
                    bodyFontFamily: 'Montserrat',
                    cornerRadius: 3,
                    intersect: false,
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            color: 'transparent',
                            zeroLineColor: 'transparent'
                        },
                        ticks: {
                            fontSize: 2,
                            fontColor: 'transparent'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        ticks: {
                            display: false,
                        }
                    }]
                },
                title: {
                    display: false,
                },
                elements: {
                    line: {
                        borderWidth: 1
                    },
                    point: {
                        radius: 4,
                        hitRadius: 10,
                        hoverRadius: 4
                    }
                }
            }
        });
    }


    //WidgetChart 4
    var ctx = document.getElementById("widgetChart4");
    if (ctx) {
        ctx.height = 100;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [
                    {
                        label: "Earning",
                        data: [
                            @foreach ($earning_per_month as $user)
                            {{$user}},
                            @endforeach
                        ],
                        borderColor: "transparent",
                        borderWidth: "0",
                        backgroundColor: "rgba(255,255,255,.3)"
                    }
                ]
            },
            options: {
                maintainAspectRatio: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        display: false,
                        categoryPercentage: 1,
                        barPercentage: 0.60,
                    }],
                    yAxes: [{
                        display: false
                    }]
                }
            }
        });
    }
</script>


@endsection
