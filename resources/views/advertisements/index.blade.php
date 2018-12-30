@extends('layouts.master')

@section('title', '广告列表')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            广告管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-shopping-bag"></i> 广告管理</a></li>
            <li class="active">广告列表</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->

        <div class="row">
            <div class="col-md-12">
                {{--default--}}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">最大股东</h3>

                        <div class="box-tools">
                            <a class="btn btn-success btn-sm" href="{{ route('advertisements.create') }}">新增广告</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center" style="width: 10px;"><a href="">#</a></th>
                                <th class="text-center" style="width: 250px"><a href="">名稱</a></th>
                                <th class="text-center" style="width: 250px"><a href="">图片和链接</a></th>
                                <th class="text-center" style="width: 250px"><a href="">状态</a></th>
                                <th class="text-center" style="width: 120px">管理功能</th>
                            </tr>
                            @foreach ($bigs as $advertisement)
                            <tr>
                                <td>{{ $advertisement->id }}</td>
                                <td style="text-align: center">{{ $advertisement->name }}</td>
                                <td>
                                    <a><img src="{{$advertisement['file_path']}}" alt="profile Pic"style="width:auto; height:auto; max-height: 200px; max-width: 200px;"></a>
                                    <br><a href="{{$advertisement->url}}">{{$advertisement->url}}</a>
                                </td>
                                <td style="text-align: center">
                                        @if($advertisement->is_used  == 0)
                                            Unpaid
                                        @elseif($advertisement->is_used  == 2)
                                            Slide
                                        @else
                                            Rotate
                                        @endif
                                </td>
                                <td class="text-center">
                                    <span style="font-weight: bold">Default!!!Can't be modified</span>
                                </td>
                            </tr>


                            @endforeach


                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                {{--slider--}}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Slider</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center" style="width: 10px;"><a href="">#</a></th>
                                <th class="text-center" style="width: 250px"><a href="">名稱</a></th>
                                <th class="text-center" style="width: 250px"><a href="">图片和链接</a></th>
                                <th class="text-center" style="width: 250px"><a href="">状态</a></th>
                                <th class="text-center" style="width: 120px">管理功能</th>
                            </tr>
                            @foreach ($sliders as $advertisement)
                                <tr>
                                    <td>{{ $advertisement->id }}</td>
                                    <td style="text-align: center">{{ $advertisement->name }}</td>
                                    <td>
                                        <a><img src="{{$advertisement['file_path']}}" alt="profile Pic"style="width:auto; height:auto; max-height: 200px; max-width: 200px;"></a>
                                        <br><a href="{{$advertisement->url}}">{{$advertisement->url}}</a>
                                    </td>
                                    <td style="text-align: center">
                                        @if($advertisement->is_used  == 0)
                                            Unpaid
                                        @elseif($advertisement->is_used  == 2)
                                            Slide
                                        @else
                                            Rotate
                                        @endif
                                </td>
                                    <td class="text-center">
                                        <a href="{{ route('advertisements.edit', $advertisement->id) }}" class="btn btn-xs btn-primary">編輯</a>
                                        <form action="{{ route('advertisements.destroy', $advertisement->id) }}" method="post" style="display: inline-block">
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

                {{--rotation--}}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rotation</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center" style="width: 10px;"><a href="">#</a></th>
                                <th class="text-center" style="width: 250px"><a href="">名稱</a></th>
                                <th class="text-center" style="width: 250px"><a href="">图片和链接</a></th>
                                <th class="text-center" style="width: 250px"><a href="">状态</a></th>
                                <th class="text-center" style="width: 120px">管理功能</th>
                            </tr>
                            @foreach ($rotations as $advertisement)
                                <tr>
                                    <td>{{ $advertisement->id }}</td>
                                    <td style="text-align: center">{{ $advertisement->name }}</td>
                                    <td>
                                        <a><img src="{{$advertisement['file_path']}}" alt="profile Pic"style="width:auto; height:auto; max-height: 200px; max-width: 200px;"></a>
                                        <br><a href="{{$advertisement->url}}">{{$advertisement->url}}</a>
                                    </td>
                                    <td style="text-align: center">
                                        @if($advertisement->is_used  == 0)
                                            Unpaid
                                        @elseif($advertisement->is_used  == 2)
                                            Slide
                                        @else
                                            Rotate
                                        @endif
                                </td>
                                    <td class="text-center">
                                        <a href="{{ route('advertisements.edit', $advertisement->id) }}" class="btn btn-xs btn-primary">編輯</a>
                                        <form action="{{ route('advertisements.destroy', $advertisement->id) }}" method="post" style="display: inline-block">
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

                {{--normal--}}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Normal</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center" style="width: 10px;"><a href="">#</a></th>
                                <th class="text-center" style="width: 250px"><a href="">名稱</a></th>
                                <th class="text-center" style="width: 250px"><a href="">图片和链接</a></th>
                                <th class="text-center" style="width: 250px"><a href="">状态</a></th>
                                <th class="text-center" style="width: 120px">管理功能</th>
                            </tr>
                            @foreach ($normals as $advertisement)
                                <tr>
                                    <td>{{ $advertisement->id }}</td>
                                    <td style="text-align: center">{{ $advertisement->name }}</td>
                                    <td>
                                        <a><img src="{{$advertisement['file_path']}}" alt="profile Pic"style="width:auto; height:auto; max-height: 200px; max-width: 200px;"></a>
                                        <br><a href="{{$advertisement->url}}">{{$advertisement->url}}</a>
                                    </td>
                                    <td style="text-align: center">
                                        @if($advertisement->is_used  == 0)
                                            Unpaid
                                        @elseif($advertisement->is_used  == 2)
                                            Slide
                                        @else
                                            Rotate
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('advertisements.edit', $advertisement->id) }}" class="btn btn-xs btn-primary">編輯</a>
                                        <form action="{{ route('advertisements.destroy', $advertisement->id) }}" method="post" style="display: inline-block">
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
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
