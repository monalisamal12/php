<?php


namespace App\Modules\Admin\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Employee
{


 
    public function getDetails($where, $selectCols = ['*'])
    {
        try {
            $result = DB::table('employee')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


   

    public function fetchemp($employee_ID, $select = ['*'])
    {
        $result = DB::table('employee')->where('employee_ID', $employee_ID)->select($select)->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    public function fetchid($employee_ID,$select = ['*'])
    {
        $result = DB::table('employee')->whereId($employee_ID)->select($select)->first();
        if ($result) {
//        die('here');
            return $result;
        } else {
            return 0;
        }
    }
    
    
    public function updatedetails($where, $data)
    {
        try {
            $result = DB::table('employee')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }
    
    public function deleteEmp()
    {
        if (func_num_args() > 0) {
            $where = func_get_arg(0);
            try {
                $result = DB::table('employee')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->delete();
                return $result;
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            throw new Exception('Argument Not Passed');
        }
    }


    public function addEmps($data)
    {
        try {

            $result = DB::table('employee')->insertGetId($data);
            if ($result) {
                return $result;

            } else {
                return 0;
            }
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }



    public function updateProxy($where, $data)
    {

        try {
            $result = DB::table('employee')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }




 
    

  


    public function getAllemployee()
    {
        $result = DB::table('employee')
            ->select()
            ->get();
        return $result;
    }











}
