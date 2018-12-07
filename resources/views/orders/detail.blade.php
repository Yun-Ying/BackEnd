@extends('layouts.master')

@section('title', '訂單列表')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                訂單管理资讯
                <small></small>
            </h1>
            {{--<ol class="breadcrumb">--}}
                {{--<li><a href="#"><i class="fa fa-shopping-bag"></i> 訂單管理</a></li>--}}
                {{--<li class="active">訂單列表</li>--}}
            {{--</ol>--}}
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        {{--<div class="box-header with-border">--}}
                            {{--<h3 class="box-title">全站訂單一覽表</h3>--}}
                            {{--<a class="btn btn-success btn-sm" href="{{ route('orders.create') }}">新增訂單</a>--}}
                            {{--<div class="box-tools">--}}

                            {{--</div>--}}
                        {{--</div>--}}
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center" style="width: 10px;">订单ID</th>
                                    <th class="text-center" style="width: 50px;">買家ID</th>
                                    <th class="text-center" style="width: 50px;">買家名稱</th>
                                    <th class="text-center" style="width: 50px;">買家Email</th>
                                    <th class="text-center" style="width: 120px">地址</th>
                                    <th class="text-center" style="width: 50px">電話</th>
                                    <th class="text-center" style="width: 50px">價錢</th>
                                    <th class="text-center" style="width: 50px">是否結單</th>
                                </tr>

                                    <tr>
                                        <td>{{ $order->id }}.</td>
                                        <td>{{ $order->user_id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->user->email }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->phone_number }}</td>
                                        <td>{{ $order->total_price }}.00</td>
                                        @if ($order->is_check === 1)
                                            <td>已結單</td>
                                        @else
                                            <td>處理中</td>
                                        @endif

                                    </tr>
                            </table>
                        </div>

                        <section id="cart_items">
                            <div class="container">

                                <div class="table-responsive cart_info">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr class="cart_menu">
                                            <td class="image" style="background-color: orange">Item</td>
                                            <td class="description" style="background-color: orange"></td>
                                            <td class="price" style="background-color: orange">Price</td>
                                            <td class="quantity" style="background-color: orange">Quantity</td>
                                            <td class="total" style="background-color: orange">Total</td>
                                            <td></td>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @foreach($items as $item)
                                        <tr>
                                            <td class="cart_product">
                                                <a href=""><img src="/{{$item['file_path']}}" alt="profile Pic"style="width:auto; height:auto; max-height: 200px; max-width: 200px;"></a>
                                            </td>
                                            <td class="cart_description" >
                                                <h4><a href="">{{ $item['name'] }}</a></h4>
                                                <p>Product ID : {{ $item['id'] }}</p>
                                            </td>
                                            <td class="cart_price">
                                                <p style="font-size: 20px; vertical-align: middle">{{ $item['price'] }}</p>
                                            </td>
                                            <td class="cart_quantity">
                                                <p style="font-size: 20px; vertical-align: middle">{{ $item['quantity'] }}</p>
                                            </td>
                                            <td class="cart_total">
                                                <p style="font-size: 20px; vertical-align: middle">{{ $item['total'] }}</p>
                                            </td>

                                        </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section> <!--/#cart_items-->

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
