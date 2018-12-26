<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>I want to be a Hokage</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">管理系統</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ (request()->is('/'))? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}">
                    <i class="fa fa-dashboard"></i> <span>主控台</span>
                </a>
            </li>
            <li class="treeview{{ (request()->is('products*'))? ' active' : '' }}">
                <a href="#">
                    <i class="fa fa-shopping-bag"></i>
                    <span>商品管理</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('products.pagging',[ 'category_id'=> 0, 'sortBy' => 'id', 'sortMethod' => 'ASC', 'page'=>0]) }}">商品列表</a></li>
                    <li><a href="{{ route('products.create') }}">新增商品</a></li>
                    <li><a href="{{ route('orders.index') }}">訂單列表</a></li>
                    {{--<li><a href="{{ route('users.index') }}">使用者列表</a></li>--}}
                    <li><a href="{{ route('categories.index') }}">分类列表</a></li>
                    <li><a href="{{ route('users.index') }}">使用者列表</a></li>
                    <li><a href="{{ route('advertisements.index') }}">广告列表</a></li>

                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
