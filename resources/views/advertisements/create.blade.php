@extends('layouts.master')

@section('title', '新增广告')

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
                <!-- .col -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">新增广告</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('advertisements.store') }}" method="post" enctype="multipart/form-data">

                            @csrf

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
                                        <label for="title">名稱</label>
                                        <input type="text" class="form-control" id="title" name="name" placeholder="請輸入公司名稱" value="{{ old('name') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="url">广告链接</label>
                                        <input type="url" class="form-control" id="url" name="url" placeholder="請輸入广告链接" value="{{ old('url') }}">
                                    </div>

                                    <div class="is_used-group" id="is_used_group">
                                        <label for="is_used">使用状态</label>
                                        <p style="font-weight: bold">1為Rotation</p>
                                        <p style="font-weight: bold">2為Slider</p>
                                        <input type="range" class="form-control" id="is_used" name="is_used" value="{{ old('is_used', 0) }}" min="0" max="2">
                                        <p id = "output" style="font-weight: bold"></p>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="cover">广告圖</label>
                                            <input type="file" id="cover" name="file">
                                        </div>
                                    </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer text-right">
                                <a class="btn btn-link" href="{{ route('advertisements.index') }}">取消</a>
                                <button type="submit" class="btn btn-primary">新增</button>
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

    {{--css--}}
    <style>
        .is_used-group {
            width: 100%; /* Width of the outside container */
        }

        /* The slider itself */
        #is_used {
            -webkit-appearance: none;  /* Override default CSS styles */
            appearance: none;
            width: 100%; /* Full-width */
            height: 25px; /* Specified height */
            background: #d3d3d3; /* Grey background */
            outline: none; /* Remove outline */
            opacity: 0.7; /* Set transparency (for mouse-over effects on hover) */
            -webkit-transition: .2s; /* 0.2 seconds transition on hover */
            transition: opacity .2s;
        }

        /* Mouse-over effects */
        #is_used:hover {
            opacity: 1; /* Fully shown on mouse-over */
        }

        /* The slider handle (use -webkit- (Chrome, Opera, Safari, Edge) and -moz- (Firefox) to override default look) */
        #is_used::-webkit-slider-thumb {
            -webkit-appearance: none; /* Override default look */
            appearance: none;
            width: 25px; /* Set a specific slider handle width */
            height: 25px; /* Slider handle height */
            background: #4CAF50; /* Green background */
            cursor: pointer; /* Cursor on hover */
        }

        #is_used::-moz-range-thumb {
            width: 25px; /* Set a specific slider handle width */
            height: 25px; /* Slider handle height */
            background: #4CAF50; /* Green background */
            cursor: pointer; /* Cursor on hover */
        }

    </style>

    {{--js part--}}
    <script>
        // the effect for range of is_used
        let slider = document.getElementById("is_used");
        let output = document.getElementById("output");
        output.innerHTML = slider.value; // Display the default slider value

        // Update the current slider value (each time you drag the slider handle)
        slider.oninput = function() {
            output.innerHTML = this.value;
            manage_label(this.value);
        }


        let label_exist  = false;
        function manage_label(value){
            if(value != 0 && !label_exist)
            {
                add_label();
                label_exist = true;
            }
            else if(value == 0 && label_exist){
                remove_label();
                label_exist = false;
            }

        }


        function add_label(){
            let div = document.createElement('div');

            div.id = 'duration_left';

            div.innerHTML =
                '<label for="duration_left">上载时数（天数）</label>\n' +
                '<input type="integer" class="form-control" id="duration_left" name="duration_left" placeholder="請輸入上载时数" value="{{ old('is_used', 0) }}">';

            document.getElementById('is_used_group').appendChild(div);
        }

        function remove_label(){
            document.getElementById('duration_left').remove();
        }
    </script>
@endsection
