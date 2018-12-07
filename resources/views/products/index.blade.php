@extends('layouts.master')

@section('title', '商品列表')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            商品管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-shopping-bag"></i> 商品管理</a></li>
            <li class="active">商品列表</li>
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
                        <h3 class="box-title">全站商品一覽表</h3>
                        <label for="category" style="margin-left: 100px">Sort By: </label>
                        <a href="{{ route('products.pagging',['category_id'=> $category_id,'sortBy' => 'name','sortMethod' => $sortMethod,'page'=>0]) }}"
                           class="btn btn-xs btn-primary" >Name</a>
                        <a href="{{ route('products.pagging',['category_id'=> $category_id,'sortBy' => 'level_id','sortMethod' => $sortMethod,'page'=>0]) }}"
                           class="btn btn-xs btn-primary" >Level</a>
                        <a href="{{ route('products.pagging',['category_id'=> $category_id,'sortBy' => 'price','sortMethod' => $sortMethod,'page'=>0]) }}"
                           class="btn btn-xs btn-primary" >Price</a>
                        <label for="category" style="margin-left: 100px">Sort Method: </label>
                        <a href="{{ route('products.pagging',['category_id'=> $category_id,'sortBy' => $sortBy,'sortMethod' => 'ASC', 'page'=>0]) }}"
                           class="btn btn-xs btn-primary" >ASC</a>
                        <a href="{{ route('products.pagging',['category_id'=> $category_id,'sortBy' => $sortBy,'sortMethod' => 'DESC', 'page'=>0]) }}"
                           class="btn btn-xs btn-primary" >DESC</a>
                        <div class="form-group">
                            <a href="{{ route('products.pagging',[
                                'category_id'=> 0,
                                'sortBy' => 'id',
                                'sortMethod' => 'ASC',
                                'page'=>0]) }}" class="btn btn-xs btn-primary"
                               style="margin-left: 10px; background-color: #985f0d; border-color: transparent; color: #eeeeee">全部</a>
                            @foreach($categories as $category)
                                <a href="{{ route('products.pagging',[
                                'category_id'=> $category->id,
                                'sortBy' => 'id',
                                'sortMethod' => 'ASC',
                                'page'=>0]) }}" class="btn btn-xs btn-primary"
                                   style="margin-left: 10px; background-color: #985f0d; border-color: transparent; color: #eeeeee">{{ $category->name }}</a>
                            @endforeach

                        </div>
                        <div class="box-tools">
                            <a class="btn btn-success btn-sm" href="{{ route('products.create') }}">新增商品</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center" style="width: 10px;"><a href="">#</a></th>
                                <th class="text-center" style="width: 250px"><a href="">名稱</a></th>
                                <th class="text-center" style="width: 250px"><a href="">分類</a></th>
                                <th class="text-center" style="width: 120px"><a href="">價格</a></th>
                                <th class="text-center" style="width: 120px">管理功能</th>
                            </tr>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}.</td>
                                <td>{{ $product->name }}</td>
                                <td style = "text-align: center" >{{ $product->Category->name }}</td>
                                <td>{{ $product->price }} 元</td>
                                <td class="text-center">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-xs btn-primary">編輯</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger">刪除</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin ">
                            @for($i=0; $i<$total_pages; $i++)
                                <li><a href="{{ route('products.pagging',[ 'category_id'=> $category_id, 'sortBy' => $sortBy, 'sortMethod' => $sortMethod, 'page' => $i]) }}">{{$i+1}}</a></li>
                            @endfor
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
