@extends('layouts.master')

@section('title', '編輯訂單')

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
                <li class="active">編輯訂單</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <!-- .col -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">編輯訂單</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('orders.update', $order->id) }}" method="post">

                            @csrf
                            @method('PATCH')

                            <div class="box-body">

                                @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> 錯誤！</h4>
                                    請修正以下表單錯誤：
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                    <div class="form-group">
                                        <label for="title">地址</label>
                                        <input type="text" class="form-control" id="title" name="address" placeholder="請輸入地址" value="{{ old('address', $order->address) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">電話</label>
                                        <input type="text" class="form-control" id="title" name="phone_number" placeholder="請輸入電話" value="{{ old('phone_number', $order->phone_number) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">價錢</label>
                                        <input type="text" class="form-control" id="title" name="total_price" placeholder="請輸入價錢" value="{{ old('total_price', $order->total_price) }}">
                                    </div>

                            <div class="box-footer text-right">
                                <a class="btn btn-link" href="#">取消</a>
                                <button type="submit" class="btn btn-primary">更新</button>
                            </div>
                        </form>
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
