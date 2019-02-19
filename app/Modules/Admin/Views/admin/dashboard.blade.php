

@extends('Admin::Layouts.adminlayout')

@section('headcontent')
@endsection

@section('dashboard','active open')

@section('pagecontent')
    <h3 class="page-title" style="color: #19658b">
        Dashboard
        <small></small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/admin/dashboard">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a class="application" href="/admin/dashboard ">Dashboard</a>
            </li>
        </ul>


        <div class="theme-panel hidden-xs hidden-sm">
            <div class="toggler">
            </div>
            <div class="toggler-close">
            </div>
            <div class="theme-options">
                <div class="theme-option theme-colors clearfix">
            <span>
            </span>
                    <ul>
                    </ul>


    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row"> 
       </div>

    
          
    <!-- END DASHBOARD STATS -->
@endsection

@section('pagescripts')
    <script type="text/javascript">
    </script>
@endsection