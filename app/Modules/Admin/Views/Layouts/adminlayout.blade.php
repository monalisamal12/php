


<!DOCTYPE html>

<head>
    @include('Admin::Layouts.headcontent')
    @yield('pageheadcontent')

    {{--<style>--}}
        {{--.collapse i{--}}
          {{--color: #fff !important;--}}
            {{--font-size: 25px !important;--}}
        {{--}--}}

        {{--.collapse .sub-menu i{--}}
            {{--font-size: 17px !important;--}}
        {{--}--}}

    {{--</style>--}}
</head>



{{--<body class="page-md page-header-fixed page-sidebar-fixed page-quick-sidebar-over-content  ">--}}

<body class="page-md page-header-fixed page-quick-sidebar-over-content  ">

<!-- BEGIN HEADER -->
<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            
            <div class="menu-toggler sidebar-toggler hide">
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->


                <!-- BEGIN TODO DROPDOWN -->

                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <span class="username username-hide-on-mobile">
                            {{\Illuminate\Support\Facades\Session::get('admin')['username']}}
                            </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            {{--<a href="extra_profile.html">--}}
                            {{--<i class="icon-user"></i> My Profile </a>--}}
                            <a href="/admin/myProfile"><i class="icon-user"></i> My
                                Profile </a>
                        </li>

                        <li class="divider">
                        </li>
                        {{--<li>--}}
                            {{--<a href="/admin/lock">--}}
                            {{--<i class="icon-lock"></i> Lock Screen </a>--}}
                        {{--</li>--}}
                        <li>
                            <a href="/admin/logout"><i class="icon-key "></i> Log
                                out</a>
                        </li>
                    </ul>
                </li>
         
            </ul>
        </div>
    </div>
</div>
<div class="clearfix">
</div>
<div class="page-container">


            <ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true"
                data-slide-speed="200">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler">
                    </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>

                <li class="@yield('dashboard')">
                    <a href="/admin/dashboard">
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>
                        <span class="selected"></span>
                    </a>
                    {{--</ul>--}}

                </li>
                
            <li class="@yield('Employee')">
                <a href="/admin/EmployeeTable">
                    <i class="fa fa-list"></i>
                    <span class="title">EmployeeTable</span>
                </a>
                {{--</ul>--}}
            </li>

                <li class="@yield('Address')">
                    <a href="/admin/AddressTable">
                        <i class="fa fa-clipboard"></i>
                        <span class="title">AddressTable</span>
                    </a>
                    {{--</ul>--}}
                </li>



            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            @yield('pagecontent')
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        <?php echo date('Y');?> &copy; GAIA.
        {{--<p id="timezone"></p>--}}

    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>


@include('Admin::Layouts.footerscripts')
@yield('pagescripts')


</body>

</html>

