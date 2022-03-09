<!DOCTYPE html>

<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('css/font.css')}}" type="text/css" />
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/morris.css')}}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('css/monthly.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('js/raphael-min.js')}}"></script>
    <script src="{{asset('js/morris.js')}}"></script>

</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{URL::to('Admin/dashboard')}}" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">

                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <span class="username">
                                <?php

                                use Illuminate\Support\Facades\Session;

                                $message = Session::get('admin_name');
                                if ($message) {
                                    echo $message;
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="{{URL::to('logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{URL::to('Admin/dashboard')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng Quan</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa  fa-briefcase"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('Admin/product/create')}}">Thêm Sản Phẩm</a></li>
                                <li><a href="{{URL::to('Admin/product')}}">Tất Cả Sản Phẩm</a></li>
                                <li><a href="{{URL::to('Admin/other')}}">Khác</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-calendar"></i>
                                <span>Danh mục dịch vụ</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('Admin/service')}}">Danh sách đăng kí</a></li>
                                <li><a href="{{URL::to('Admin/meet')}}">Lịch Hẹn</a></li>
                                <li><a href="{{URL::to('Admin/other')}}">Khác</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-user"></i>
                                <span>Khách hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('Admin/auth')}}">Danh Sách Khách Hàng</a></li>
                                <li><a href="{{URL::to('Admin/other')}}">Khác</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa  fa-bar-chart-o"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('Admin/order')}}">Danh Sách Đơn Hàng</a></li>
                                <li><a href="{{URL::to('Admin/other')}}">Khác</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Tin Tức</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('Admin/news')}}">Danh Sách Tin Tức</a></li>
                                <li><a href="{{URL::to('Admin/news/create')}}">Tạo Tin Tức</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa  fa-comment-o"></i>
                                <span>Phản Hồi</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('Admin/feedback')}}">Xem Tất Cả</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa  fa-cog"></i>
                                <span>Cài Đặt</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('Admin/Bank')}}">Ngân Hàng</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        @yield('layout')
        <!--main content end-->
        <div class="footer">
            <div class="wthree-copyright">
                <p>© 2021 Visitors. All rights reserved | Design by <a href="#">LÊ HỮU HOÀN</a></p>
            </div>
    </section>
    </section>

    </div>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('js/jquery.nicescroll.js')}}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('js/jquery.scrollTo.js')}}"></script>
    @yield('js')
</body>

</html>
