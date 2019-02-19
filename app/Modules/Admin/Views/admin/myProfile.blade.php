
{{--Created by  Monali Samal
      * @author Monali Samal (monalisamal@globussoft.in)
--}}

@extends('Admin::Layouts.adminlayout')

@section('pagecontent')


    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="">

            <div class="row">
                <div class="col-md-12">


                    <div class="portlet-body">
                        <div class="tabs-left row">
                            <div class="col-md-12 col-xs-12">
                                <div id="a">
                                    <div class="row" style="margin-top:3%;">
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="page-head">
                                                <!-- BEGIN PAGE TITLE -->
                                                <div class="page-title">
                                                    {{--<h1 style="color: black"> {{$data['username']}}</h1>--}}

                                                </div>
                                                <!-- END PAGE TITLE -->

                                            </div>
                                            <a href="/admin/changePassword" name="logout" class="btn btn-success btn-circle" value="changePassword"><i class="fa fa-lock"></i>Change Password</a>
                                            </br>
                                            <ul class="page-breadcrumb breadcrumb">
                                                <li>
                                                    <a href="/admin/dashboard">Home</a>
                                                    <i class="icon-home"></i>
                                                </li>


                                            </ul>
                                            <table class="table table-hover table-condensed">
                                                <tbody>
                                                <tr>
                                                    <td><i class="fa fa-user"></i></td>
                                                    <td>{{$data['username']}}</td>
                                                    <td> Username</td>
                                                </tr>


                                                <tr>
                                                    <td><i class="fa fa fa-at"></i></td>
                                                    <td>{{$data['email']}}</td>
                                                    <td> E-Mail</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End: life time stats -->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>


    <!-- END CONTENT -->
@endsection
@section('pagescripts')

@endsection



