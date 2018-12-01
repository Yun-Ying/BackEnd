@extends('layouts.master')

@section('title', '訂單列表')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            訂單管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-shopping-bag"></i> 訂單管理</a></li>
            <li class="active">訂單列表</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">全站訂單一覽表</h3>
                            {{--<a class="btn btn-success btn-sm" href="{{ route('orders.create') }}">新增訂單</a>--}}
                        <div class="box-tools">

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center" style="width: 10px;">#</th>
                                <th class="text-center" style="width: 50px;">使用者ID</th>
                                <th class="text-center" style="width: 120px">地址</th>
                                <th class="text-center" style="width: 50px">電話</th>
                                <th class="text-center" style="width: 50px">價錢</th>
                                <th class="text-center" style="width: 50px">是否結單</th>
                                <th class="text-center" style="width: 120px">管理功能</th>
                            </tr>

                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}.</td>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->phone_number }}</td>
                                <td>{{ $order->total_price }}.00</td>
                                @if ($order->is_check === 1)
                                    <td>已結單</td>
                                @else
                                    <td>處理中</td>
                                @endif
                                {{--<td>{{ $product->price }} 元/{{ $product->unit }}</td>--}}
                                <td class="text-center">
                                @if ($order->is_check === 1)
                                    <a href="{{ route('orders.check', $order->id) }}" class="btn btn-xs btn-primary" style = "background-color: green">返回</a>
                                @else
                                    <a href="{{ route('orders.check', $order->id) }}" class="btn btn-xs btn-primary">結單</a>
                                @endif

                                <form action="{{ route('orders.destroy', $order->id) }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger" >刪除</button>
                                </form>

                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-xs btn-primary"  style="background-color: orange">編輯</a>

                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-xs btn-primary" style="background-color: black">詳細資料</a>
                                </td>

                            </tr>
                            @endforeach

                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
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
