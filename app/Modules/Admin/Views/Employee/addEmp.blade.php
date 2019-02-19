
@extends('Admin::Layouts.adminlayout')
@section('pagecontent')
    <h1 class="page-title" style="color:#06738b">Add Users</h1>
    <div class="row" style="min-height:470px;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body" style="color: rebeccapurple">

                    @if (session('UserMsg'))
                        <div class="alert alert-success">
                            {{ session('UserMsg') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form class="form" role="form" method="post" action="/admin/addEmployee">


                        <div class="row">

                            <div class="form-group floating-label col-md-6">
                                <label for="demo1" style="color: black">Firstname</label>
                                <input class="form-control" id="demo1" type="text" name="firstname"
                                       value="{{old('firstname')}}">

                                <div class="error" style="color:red">{{ $errors->first('firstname') }}</div>
                            </div>

            
                            <div class="form-group floating-label col-md-6">
                                <label for="demo1"style="color: black">	Address</label>
                                <select class="form-control" name="	address"  id="demo1" value="{{old('	address')}}">
                                    <option value="{{old('address')}}">select...</option>

                                   <option value="1">Present address</option>
                                  <option value="2">Permanent address</option>
                                    <option value="3">Office address</option>
                                
                                </select>
                                <div class="error" style="color:red">{{ $errors->first('address') }}</div>--}}
                            </div>
                        </div>
                        <div class="form-group floating-label col-md-6">
                                <label for="demo1"style="color: black">	Gender</label>
                                <select class="form-control" name="gender"  id="demo1" value="{{old('gender')}}">
                                    <option value="{{old('gender')}}">select...</option>
                                   <option value="1">male</option>
                                  <option value="2">Female</option>
                                </select>
                                <div class="error" style="color:red">{{ $errors->first('gender') }}</div>--}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn  btn-primary">Submit</button>
                            <a href="{{URL::previous()}}" class="btn  btn-warning" style="margin-left:1%;" type="button"><i
                                        class="fa fa-times"></i>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('pagescripts')

@endsection