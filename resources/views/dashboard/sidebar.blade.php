<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('public/adminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
{{--            <li class="header">MAIN NAVIGATION</li>--}}
{{--            <li class="treeview">--}}
{{--                <a href="#">--}}
{{--                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>--}}
{{--                    <span class="pull-right-container">--}}
{{--              <i class="fa fa-angle-left pull-right"></i>--}}
{{--            </span>--}}
{{--                </a>--}}
{{--                <ul class="treeview-menu">--}}
{{--                    <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>--}}
{{--                    <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="treeview active">--}}
{{--                <a href="#">--}}
{{--                    <i class="fa fa-files-o"></i>--}}
{{--                    <span>Layout Options</span>--}}
{{--                    <span class="pull-right-container">--}}
{{--              <span class="label label-primary pull-right">4</span>--}}
{{--            </span>--}}
{{--                </a>--}}
{{--                <ul class="treeview-menu">--}}
{{--                    <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>--}}
{{--                    <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>--}}
{{--                    <li class="active"><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>--}}
{{--                    <li><a href="collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <!-- get second segment -->
            <?php $segment = Request::segment(2);?>

            <li class="<?=$segment == 'categories' ? 'active' : '' ?>">
                <a href="{{ route('categories')}}">
                    <i class="fa fa-th"></i> <span>Category</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
                </a>
            </li>
            <li class="<?=$segment == 'products' ? 'active' : '' ?>">
                <a href="{{ route('products')}}">
                    <i class="fa fa-th"></i> <span>Products</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>
                </a>
            </li>
            <li class="<?=$segment == 'attributes' ? 'active' : '' ?>">
                <a href="{{ route('attributes')}}">
                    <i class="fa fa-th"></i> <span>Attribute</span>
                    <span class="pull-right-container">
                      <small class="label pull-right bg-green"></small>
                    </span>
                </a>
            </li>

            <li class="<?=$segment == 'tags' ? 'active' : '' ?>">
                <a href="{{ route('tags')}}">
                    <i class="fa fa-th"></i> <span>Tags</span>
                    <span class="pull-right-container">
                      <small class="label pull-right bg-green"></small>
                    </span>
                </a>
            </li>
<!--            <li>
                <a href="../widgets.html">
                    <i class="fa fa-th"></i> <span>Widgets</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
                </a>
            </li>-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->
