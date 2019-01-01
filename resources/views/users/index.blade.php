@extends('layouts.master')

@section('title', '使用者列表')

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
            <li><a href="#"><i class="fa fa-shopping-bag"></i> 使用者资料管理</a></li>
            <li class="active">使用者列表</li>
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
                        <h3 class="box-title">全站使用者一覽表</h3>

                        <div class="box-tools">
                            <a class="btn btn-success btn-sm" href="{{ route('users.create') }}">新增使用者</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center" style="width: 10px;"><a href="">#</a></th>
                                <th class="text-center" style="width: 250px"><a href="">姓名</a></th>
                                <th class="text-center" style="width: 250px"><a href="">邮箱</a></th>
                                <th class="text-center" style="width: 120px"><a href="">是否为管理者</a></th>
                                <th class="text-center" style="width: 120px"><a href="">经验值</a></th>
                                <th class="text-center" style="width: 120px">管理功能</th>

                            </tr>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}.</td>
                                <td>{{ $user->name }}</td>
                                <td style = "text-align: center" >{{ $user->email }}</td>
                                @if($user->isRoot)
                                    <td style="background-color: lawngreen">是</td>
                                @else
                                    <td style="background-color: indianred">否</td>
                                @endif
                                <td>{{ $user->exp }}</td>
                                <td class="text-center">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-xs btn-primary">編輯</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline-block">
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
