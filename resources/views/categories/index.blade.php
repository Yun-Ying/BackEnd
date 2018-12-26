@extends('layouts.master')

@section('title', '分类列表')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            分类管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-shopping-bag"></i> 分类管理</a></li>
            <li class="active">分类列表</li>
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

                        <div class="box-tools">
                            <a class="btn btn-success btn-sm" href="{{ route('categories.create') }}">新增分类</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center" style="width: 10px;"><a href="">#</a></th>
                                <th class="text-center" style="width: 250px"><a href="">名稱</a></th>
                                <th class="text-center" style="width: 120px">管理功能</th>
                            </tr>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}.</td>
                                <td>{{ $category->name }}</td>
                                @if($category->id > 16)
                                <td class="text-center">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-xs btn-primary">編輯</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger">刪除</button>
                                    </form>
                                </td>
                                @endif

                                @if($category->id <= 16)
                                    <td class="text-center">
                                        <span style="font-weight: bold">This is Default Category, Can't be modified!</span>
                                    </td>

                                @endif
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
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
