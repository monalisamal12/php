@extends('Admin::Layouts.adminlayout')
@section('Address','active open')
@section('pageheadcontent')
    <link rel="stylesheet" type="text/css" href="/Test/assets/export/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">

    <link rel="stylesheet" href="/Test/assets/datatables/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="/Test/assets/datatables/css/dataTables.bootstrap.css"/>


<style>

    #editUserModal input {
        padding: 5px;
    }

    .link-width {
        max-width: 140px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endsection

@section('pagecontent')
    <h1 class="page-title">Address Table</h1>
    <div class="row" style="min-height:470px;">

        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title" style="padding-top:0.6%;">Address Configuration</h3>
                    <div class="panel-tool-options" style="margin-top: 20px;">

                    </div>
                </div>

              
                           
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title" style="padding-top:0.6%;">Address Lists</h3>
                    <div class="panel-tool-options" style="margin-top: 20px;">
                        <div class="col-md-4 pull-left">
                             <span id="Loader1" hidden>
                            <img src='/assets/images/ajax-loading.gif'/>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="margin-top:10px;">
                    <div class="table-responsive">
                        <table id="DataTable"
                               class="table table-striped table-bordered table-hover dataTables-example"
                               style="margin-top:2%;">
                            <thead style="color: #020200">
                            <tr>
                                <th width="50px"><input type="checkbox" id="master"></th>
                                <th>id</th>
                                <th>Employee_ID</th>
                                <th>Address</th>
                                <th>updated_at</th>
                                <th>edit</th>
                                <th>Delete</th>
                                <th>Details</th>

                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="editUserModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(-45deg, #661422, #66125a); color: #fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Address</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-11">
                            <form id="editProfileForm">
                                <table class="table table-responsive table-hover" id="viewTable">
                                    <tbody>
                                    

                                    <tr>
                                        <td colspan="2">
                                        employee_ID:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="employee_ID"
                                                           id="employee_ID" placeholder="employee_ID"
                                                           required/> </strong>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="2">
                                            Address:
                                        </td>
                                        <td colspan="2">
                                            <strong><input type="text" class="form-control" name="address"
                                                           id="address" placeholder="address"
                                                           required/> </strong>
                                        </td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success  updateGeneralInfo"><span>Save Changes </span>
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <!--Modal for AddProxies-->
    

    
   
@endsection


@section('pagescripts')


    <script>
        $(document).ready(function () {
        
            var grid;
            var TabelDetails = function () {
                grid = $('#DataTable').DataTable({
                    processing: true,
                    destroy: true,
                    serverSide: true,
                    ajax: '/admin/addressAjaxDatables',
                    columns: [
                        {data: 'check', name: 'check', orderable: false, searchable: false},
                        {data: 'id', name: 'id'},
                        {data: 'employee_ID', name: 'employee_ID'},
                        {data: 'address', name: 'address'},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'edit', name: 'edit'},
                        {data: 'details', name: 'details'},
                        {data: 'delete', name: 'delete'},
                    ],
                    order: [[1, 'desc']],

                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    pageLength: 10,
                    lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
                    'rowCallback': function (row, data, index) {

                    }

                });

            };


          
        });

        
        var id;
            $(document).on('click', '.editUserdetails', function () {
                console.log(' data Continue --------------------=======================', $(this).attr('data-id'));
                id = $(this).attr('data-id');
                $.ajax({
                    url: '/admin/EditAjaxHandlerAddress',
                    dataType: 'json',
                    type: 'post',
                    data: {	id:id},

                    success: function (res) {

                        console.log(res);
                        var userDetails = res.data;
                        if (res['status'] == 200) {

                            $('#employee_ID').val(userDetails.employee_ID);
                            $('#address').val(userDetails.address);
                        } else {
                            toastr.error(res.msg, {timeOut: 4000});
                        }
                    }

                });
            });
                       
            $(document.body).on('click', '.deleteEmp', function () {
                var obj = $(this);
                var id = $(this).attr('data-pid');
                var messageBox = confirm('Are you sure want to delete ? ');
                if (messageBox) {
                    $.ajax({
                        url: '/admin/deleteAjaxHandler',
                        type: 'post',
                        dataType: 'json',
                        data: {id: id},
                        success: function (response) {
                            if (response['status'] == 200) {
                                obj.parent().parent().remove();
                                toastr.success(response.msg);
                            }
                            else
                                toastr.error(response.msg);

                        }

                    });
                }
            });
      

            var id;
            $(document).on('click', '.updateGeneralInfo', function () {

                $.ajax({
                    url: '/admin/UpdateAjaxHandelerAddress',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'employee_ID': $('#employee_ID').val(),
                        'address': $('#address').val(),
                        'id': id,
                    },
                    success: function (res) {
                        if (res['status'] == 200) {
                            toastr.success(res.message);
                            $('#datatable_ajax').DataTable().ajax.reload();
                            $('#editUserModal').modal('hide');
                        } else if (res['status'] == 201) {
                            toastr.warning(res.message, {timeOut: 2000});
                        } else
                            toastr.error(res.message, {timeOut: 2000});
                    }

                });

            });



            var id;
            $(document.body).on('click', '.show-details', function (e) {
                e.preventDefault();
                id = $(this).attr('data-id');

                $.ajax({
                    url: '/admin/getMoreDetails',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'id': id,
                    },
                    success: function (res) {
                        if (res['status'] == 200) {
                            $('#id').text(res.userDetails.id);
                            $('#address').text(res.userDetails.address);
                            $('#employee_ID').text(res.userDetails.employee_ID);
                        } else {
                            toastr.error(res.msg, {timeOut: 4000});
                        }
                    }

                });
            });

    </script>


@endsection