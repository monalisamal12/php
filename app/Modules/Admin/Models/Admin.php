<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Admin
{
   
    public function registerdata($fillable)
    {
        $result = DB::table('users')->insertGetId($fillable);
        if ($result) {
            return ($result);

        } else {
            return 0;
        }
    }

    // here $select used for total data  insert
    public function fetchid($userid,$select = ['*'])
    {
        $result = DB::table('users')->whereId($userid)->select($select)->first();
        if ($result) {
//        die('here');
            return $result;
        } else {
            return 0;
        }
    }


    public function updateUserWhere($where, $data)
    {

        try {
            $result = DB::table('packages')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    public function AvailableDataUpdate($where, $data)
    {

        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $data) {
            echo $data->getMessage();
        }
    }


    public function DataUpdate($where, $data)
    {
        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


   
    public function userPasswordChange($change)
    {
        $result = DB::table('users')->where('id', Auth::id())->update($change);
        if ($result) {
            return $result;
        } else {
            return 0;
        }

    }

    public function EditUpdate($change)
    {
        $result = DB::table('users')->where('id', Auth::id())->update($change);
        if ($result) {
            return $result;
        } else {
            return 0;
        }

    }

    public function updateUserDetails($where, $data)
    {
        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return ($result) ? $result : 0;
        } catch (QueryException $e) {
            dd($e->getMessage());
            return 0;
        }

    }


  
    public function OrderUpdate($where, $data)
    {
        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


  
    public function updateEdit($where, $data)
    {
        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);
            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


 
    public function getUserDetails($where, $selectCols = ['*'])
    {
        try {
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }

    public function getTransctionDetails($where, $selectCols = ['*'])
    {
        try {
            $result = DB::table('transactions')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->join('users', 'users.id', '=', 'transactions.user_id')
                ->select($selectCols)
                ->get();
            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }

    public function getOrdersDetails($where, $column = ['*'])
    {
        try {
            $result = DB::table('orders')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->select($column)
//                ->order_by($datetime)
                ->get();

            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllFilterUsers($where, $sortingOrder, $iDisplayStart, $iDisplayLength)
    {

        try {
            if ($iDisplayLength < 0) {
                $result = DB::table('users')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->select(['*'])
                    ->get();
            } else {
                $result = DB::table('users')
                    ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                    ->orderBy($sortingOrder[0], $sortingOrder[1])
                    ->skip($iDisplayStart)->take($iDisplayLength)
                    ->select(['*'])
                    ->get();
            }
            if ($result)
                return $result;
            else
                return 0;
        } catch (QueryException $exc) {
//            echo $exc->getMessage();
            return 2;
        }
    }


    public function getUserDetailsDatabase($where)
    {
        $selectCols = array('id');
        try {
            $res = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return $res;
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }

    public function updateUser()
    {
        try {
            $where = func_get_arg(0);
            $data = func_get_arg(1);
            $result = DB::table('users')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->update($data);

            if ($result == 0) {
                return 2;
            } else if ($result) {
                return 1;
            } else {
                return 0;
            }
        } catch (QueryException $exc) {
            return 0;
//            return $exc->getMessage();

        }
    }


    public function fetchUsers($id, $select = ['*'])
    {
        $result = DB::table('users')->where('id', $id)->join('orders', 'orders.order_id', '=', 'orders.comment_id')->select($select)->first();
        if ($result) {
            return $result;
        } else {
            return 0;
        }
    }


    public function getTransction($select = ['*'])
    {
        $result = DB::table($this->table)
            ->select($select)
            ->get();
        return $result;
    }


  



   
    public function getRecurringDetails($where, $selectCols = ['*'])
    {
        try {
            $result = DB::table('recurring_profiles')
                ->whereRaw($where['rawQuery'], isset($where['bindParams']) ? $where['bindParams'] : array())
                ->select($selectCols)
                ->get();
            return $result;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }


    public function deleteUsers()
    {
        if (func_num_args() > 0) {
            $where = func_get_arg(0);
            try {
                $result = DB::table('users')
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

}

