<?php


namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\DBClass;
use App\Modules\Admin\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;
use  Validator;
use users;
use App\User;

class AddressController extends Controller
{
   
    public function AddressTable()
    {

        return view("Admin::Address.address");
    }

    
   
   
    public function addressAjaxDatables()
    {
        $objEmpModel = new Address();
        $addressDetails = $objEmpModel->getAlladdress();

        $AddDatas = new Collection();
        $addressDetails = json_decode(json_encode($addressDetails), true);

        $i = 0;
        
            $id = $Adds['id'];
//
            $EmpDatas->push([
                'check' => '<input type="checkbox" class="sub_chk" data-id ="' . $Adds['id'] . '" name="checkbox" value="' . $Adds['id'] . '">',
                'id' => ++$i,
                'employee_ID' => $Adds['employee_ID'],

                'address' => $Adds['address'],
                'updated_at' => $this->convertUT($Adds['updated_at']),
                'delete' => '<span data-pid="' . $id . '" class="deleteEmp" title="Deleteaddress." data-placement="top"> <a class="btn btn-sm" style="margin-left: 10%;">
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

        return DataTables::of($AddDatas)->rawColumns(['check', 'edit', 'delete','details'])->make(true);

    }

    public function deleteAddressjaxHandler(Request $req)
    {
        if ($req->isMethod('post')) {
            $id = $req->input('id');
            $objModelEmp = new Address();
            $deletedEmp = $objModelEmp->deleteEmp(['rawQuery' => 'id = ?', 'bindParams' => [$i]]);
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


  

    public function addAddress(Request $request)
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


            $rules = [
                'address' => 'required',


            ];
            $message = [
                'address' => 'Please Enter address',


            ];

            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            }
            try {
                $fillable = array();
                $fillable['address'] = $dbInfo;
                $fillable['updated_at'] = time();;

                $objModelUsers = new Address();
                $result = $objModelUsers->addEmpsAddress($fillable);
//            dd($result);
                if ($result) {
                    return back()->with('Address', 'Address  has been added successfully.');
                } else {
                    return back()->with('Address', 'Something went wrong, please try after sometime.');

                }
            } catch (QueryException $exc) {
            }

        }
        return view('Admin::Address/addAddress');

    }


    public function EditAjaxHandlerAddress(Request $request)
    {
        if ($request->isMethod('post')) {
            $objEmpModel = new Address();
            $userDetails = $objEmpModel->fetchemp($request->input('id'));
            $userDetails = json_decode(json_encode($userDetails), true);
            if ($userDetails)
                echo json_encode(['status' => 200, 'msg' => 'Address details found.', 'data' => $userDetails]);
            else
                echo json_encode(['status' => 400, 'msg' => 'Address details not found.']);
        } else {
            echo json_encode(['status' => 401, 'msg' => 'Request couldnt be completed,Only post method is allowed.']);
        }

    }


    public function UpdateAjaxHandelerAddress(Request $request)
    {
        {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'address' => 'required',
                ]);
                if ($validator->fails()) {
                    echo json_encode(['status' => 400, 'message' => array_values(json_decode($validator->messages(), true))[0][0]]);
                    die;
                }
                $postData = $request->all();
                $admindataparse = new Address();
                $whereForUpdate = ['rawQuery' => 'id = ?', 'bindParams' => [$postData['id']]];
                unset($postData['id']);
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


    public function getMoreDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $objAdminModel = new Address();
            $select = [
    
                DB::raw('CASE 
          WHEN rated_app=1 THEN \'Present address \'
          WHEN rated_app=2 THEN\'Permanent address\'
          WHEN rated_app=3 THEN\'Office address\'
          END as address')
            
               ,'updated_at'];

            $userDetails = $objAdminModel->fetchid($request->input('id'), $select);
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









