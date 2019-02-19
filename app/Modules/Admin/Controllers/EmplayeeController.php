<?php


namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\DBClass;
use App\Modules\Admin\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
//use Yajra\Datatables\Datatables;
use  Validator;
use users;
use DataTables;
use App\User;

class EmplayeeController extends Controller
{
   
    public function EmployeeTable()
    {

        return view("Admin::Employee.employee");
    }

    
   
   
    public function EmployeeAjaxDatables()
    {
        $objEmpModel = new Employee();
        $employeeDetails = $objEmpModel->getAllemployee();

        $EmpDatas = new Collection();
        $employeeDetails = json_decode(json_encode($employeeDetails), true);

        $i = 0;
        
            $id = $Emps['employee_ID'];
//
            $EmpDatas->push([
                'check' => '<input type="checkbox" class="sub_chk" data-id ="' . $Emps['employee_ID'] . '" name="checkbox" value="' . $Emps['employee_ID'] . '">',
                'employee_ID' => ++$i,
                'firstname' => $Emps['firstname'],
                'address' => $Emps['address'],
                'gender' => $Emps['gender'],
                'updated_at' => $this->convertUT($Emps['updated_at']),
                'delete' => '<span data-pid="' . $id . '" class="deleteEmp" title="Delete Proxies." data-placement="top"> <a class="btn btn-sm" style="margin-left: 10%;">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </span>',
               'edit' => '<a href="javascript:;" class="editUserdetails" data-toggle="modal"data-target="#editUserModal" data-id="' . $value['id'] . '">
                                   <i class="fa fa-pencil-square-o"></i></span>
                                          </a>',
            'details' =>' <a href="javascript:;" style="margin-left:10px;" class="show-details" data-toggle="modal" title="Details" data-target="#showDetails" data-id="' . $value['id'] . '">
                                          <button class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></button>&nbsp;
                                             </a>'



            ]);

        return DataTables::of($EmpDatas)->rawColumns(['check', 'edit', 'delete','details'])->make(true);

    }

    public function deleteEmpAjaxHandler(Request $req)
    {
        if ($req->isMethod('post')) {
            $employee_ID = $req->input('employeeID');
            $objModelEmp = new Employee();
            $deletedEmp = $objModelEmp->deleteEmp(['rawQuery' => 'employee_ID = ?', 'bindParams' => [$employee_ID]]);
            if ($deletedEmp)
                echo json_encode(['status' => 200, 'msg' => 'Record has been successfully deleted']);
            else
                echo json_encode(['status' => 400, 'msg' => 'Some Error Occurred Error. Please reload the page and try again.']);
        }
    }


    public function convertUT($ptime)
    {
        if ($ptime == 0) {
            return '-';
        }
        $difftime = time() - $ptime;
        $afterFlag = '';

        if ($difftime < 1) {
            return '0 secs';

        }

        $timeArr = array(365 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'min',
            1 => 'sec'
        );
        $timeArr_plural = array('year' => 'years',
            'month' => 'months',
            'day' => 'days',
            'hour' => 'hours',
            'min' => 'mins',
            'sec' => 'secs'
        );

        foreach ($timeArr as $secs => $str) {
            $d = $difftime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $afterFlag . $r . ' ' . ($r > 1 ? $timeArr_plural[$str] : $str);
            }
        }
    }


  

    public function addEmployee(Request $request)
    {

        if ($request->isMethod('post')) {
            global $dbInfo;
            global $dbData;
           

            $info = $request->input('address');
            if ($info === "Present address") {
                $dbInfo = "1";
            } elseif ($info === "Permanent address") {
                $dbInfo = "2";
            } elseif ($info === "Office address") {
                $dbInfo = "3 ";
            }

            $info = $request->input('gender');
            if ($info === "male") {
                $dbData = "1";
            } elseif ($info === "Female") {
                $dbData = "2";
         
            }

            $rules = [
                'firstname' => 'required',
                'address' => 'required',
                'gender' => 'required',


            ];
            $message = [
                'firstname' => 'Please Enter firstname',
                'address' => 'Please Enter address',
                'gender' => 'Please Enter gender',


            ];

            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            }
            try {
                $fillable = array();
                $fillable['firstname'] = $request->input('firstname');
                $fillable['address'] = $dbInfo;
                $fillable['gender'] = $dbData;
                $fillable['updated_at'] = time();;

                $objModelUsers = new Employee();
                $result = $objModelUsers->addEmps($fillable);
//            dd($result);
                if ($result) {
                    return back()->with('Employee', 'Employee  has been added successfully.');
                } else {
                    return back()->with('Employee', 'Something went wrong, please try after sometime.');

                }
            } catch (QueryException $exc) {
            }

        }
        return view('Admin::Employee/addEmp');

    }


    public function EditAjaxHandlerEmployee(Request $request)
    {
        if ($request->isMethod('post')) {
            $objEmpModel = new Employee();
            $userDetails = $objEmpModel->fetchemp($request->input('employee_ID'));
            $userDetails = json_decode(json_encode($userDetails), true);
            if ($userDetails)
                echo json_encode(['status' => 200, 'msg' => 'Emp details found.', 'data' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'Emp details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }

    }


    public function UpdateAjaxHandelerEmp(Request $request)
    {
        {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'firstname' => 'required',
                    'address' => 'required',
                    'gender' => 'required',
                ]);
                if ($validator->fails()) {
                    echo json_encode(['status' => 400, 'message' => array_values(json_decode($validator->messages(), true))[0][0]]);
                    die;
                }
                $postData = $request->all();
                $admindataparse = new Employee();
                $whereForUpdate = ['rawQuery' => 'employee_ID = ?', 'bindParams' => [$postData['employee_ID']]];
                unset($postData['employee_ID']);
                $updated = $admindataparse->updatedetails($whereForUpdate, $postData);
                if ($updated)
                    echo json_encode(['status' => 200, 'message' => 'Updated successfully.']);
                else if ($updated == 0)
                    echo json_encode(['status' => 201, 'message' => 'You have made no changes to save.']);
                else
                    echo json_encode(['status' => 400, 'message' => 'Something went wrong, please try again.']);
            } else {
                echo json_encode(['status' => 401, 'message' => 'Request not allowed, Only post request is allowed']);
            }
        }
    }


    public function getMoreEmpDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $objAdminModel = new Employee();
            $select = [
    
                DB::raw('CASE 
          WHEN rated_app=1 THEN \'Present address \'
          WHEN rated_app=2 THEN\'Permanent address\'
          WHEN rated_app=3 THEN\'Office address\'
          END as address'),
                DB::raw('CASE 
                WHEN device_type=1 THEN \'male\'
                WHEN device_type=2 THEN \'female \'
                END as gender'),
            
                'firstname','updated_at'];

            $userDetails = $objAdminModel->fetchid($request->input('employee_ID'), $select);
            $userDetails = json_decode(json_encode($userDetails), true);
            if (isset($userDetails) && !empty($userDetails))
                echo json_encode(['status' => 200, 'msg' => 'Details Fetch Sucessfully .', 'userDetails' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'Emp details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }
    }
}


















