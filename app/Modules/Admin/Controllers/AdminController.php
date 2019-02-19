<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\Admin;
use function FastRoute\TestFixtures\all_options_cached;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use users;
use DataTables;

class AdminController extends Controller
{
   
    public function registration(Request $request)
    {
        if (Session::has('admin')) {
            return back()->with('status', "You need to Logout first");
        }
        if ($request->isMethod('post')) {
           
            $rules = [
                'firstname' => 'required|max:15|min:3|',
                'lastname' => 'required|max:15|min:3|',
                'email' => 'required|email',
                'password' => 'required',
                'address' => 'required',
                'DOB' => 'DOB',


            ];

            $message = [
                'firstname.required' => 'enter your firstname',
                'lastname.required' => 'enter your lastname',
                'email.required' => 'enter Your  email',
                'password.required' => 'enter Your password',
                'DOB.required' => 'enter Your DOB',
                'address.required' => 'enter Your address',
            ];

            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            } else {
              
                $fillable = array();
                $fillable['firstname'] = $request->input('firstname');
                $fillable['lastname'] = $request->input('lastname');
                $fillable['email'] = $request->input('email');
                $fillable['password'] = Hash::make($request->input('password'));
                $fillable['role'] = "0";
                $fillable['DOB'] = $request->input('DOB');
                $fillable['address'] = $request->input('address');
                $fillable['activation_otp'] = str_random(6);
                $objectmodeluser = new Admin();
                $result = $objectmodeluser->registerdata($fillable);
                $activation_otp = str_random(6);
                $email_id = "monalisamal@gmail.com";
                $message = ($request->message);
                $from = new \SendGrid\Email(null, "useradmin_project@support.in");
                $subject = " SendGrid PHP Library!";
                $to = new \SendGrid\Email(null, $email_id);
                $content = new \SendGrid\Content("text/plain", "<!DOCTYPE html>
<html lang=\"en-US\">
<head>
    <meta charset=\"utf-8\">
</head>
<body>

<h2>Verify Your Email Address</h2>
<h2>this is the mail</h2>


<div>
    Thanks for creating an account with the verification demo app.
<a href=" . "http://127.0.0.1:8000/admin/activation/" . $activation_otp . ">Link</a>

</div>

</body>
</html>");
                $mail = new \SendGrid\Mail($from, $subject, $to, $content);
                $apiKey = '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';
                $sg = new \SendGrid($apiKey);
                $response = $sg->client->mail()->send()->post($mail);
                echo "mail send succesfully !";

                if ($request) {
                    return redirect('/admin/login')->with('status', 'Registration sucessfully');
                } else {
                    return back('/admin/register');
                }
            }
        }
        return view('Admin::admin/register');
    }


    public function adminLogin(Request $request)
    {


        if (Session::has('admin')) {
            return back()->with('status', "You need to Logout first");
        }
        if ($request->isMethod('post')) {
            $rules = [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ];
            $message = [
                'email.required' => 'Enter a correct email',
                'password.required' => 'Enter your correct password',

            ];

            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            } else {
                $email = $request->input('email');
                $password = $request->input('password');
                if (Auth::attempt(['email' => $email, 'password' => $password])) {
                    $userdata = json_decode(Auth::User(), true);
                    $sessionName = 'admin';
                    Session::put($sessionName, $userdata);
                    if (Auth::user()->role == '0') {

                        return redirect("/admin/dashboard")->with('status', 'welcome!');
                    } else {
                        return redirect("/admin/login")->with('status', 'You are not authorized');
                    }
                } else {
                    return back()->with('error', 'Please Provide Valid Credentials..!!');
                }
            }
        }
        return view("Admin::admin.login");

    }

    public function adminDashboard(Request $request)
    {
        return view('Admin::admin.dashboard');

    }
    
   
    

    public function adminLogout()
    {
        Session::flush();
        return redirect('/admin/login');
    }


   
    public function forgotPassword(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'email' => 'required|email'
//        ]);

//
//        request()->validate([
//            'email' => 'required|email',
//
//            'password' => 'required',
//        ],
//            ['email.email'=>'Invalid email code.']);

//        if ($request->isMethod('post')) {

        $email = $request->input('email');

        $fillable = array();
        $fillable['token'] = str_random(30);
        $admin = new Admin();
        $pd_reset_token = str_random(30);
        $email_id = "yogeshglobussoft@gmail.com";

        $message = ($request->message);
        $from = new \SendGrid\Email(null, "useradmin_project@support.in");
        $subject = " Forgot Password!";
        $to = new \SendGrid\Email(null, $email_id);
        $content = new \SendGrid\Content("text/html", "<!DOCTYPE html>
<html lang=\"en-US\">
<head>
    <meta charset=\"utf-8\">
</head>
<body>
<h2>Verify Your Email Address</h2>
<h2>this is the mail</h2>
<div>
    Thanks for creating an account with the verification demo app.
    <a href=" . "http://127.0.0.1:8000/admin/resetpassword/" . $pd_reset_token . ">Link</a>

</div>
</body>
</html>");

        $mail = new \SendGrid\Mail($from, $subject, $to, $content);
        $apiKey = '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';
        $sg = new \SendGrid($apiKey);
        $response = $sg->client->mail()->send()->post($mail);
//        dd($response);

        $result = DB::table('users')->where('role', 0)->update(['pd_reset_token' => $pd_reset_token]);


//        }
//        return redirect('/admin/login');

        return redirect('/admin/login')->with(['status' => "Please check your mail for Reset Password link"]);

    }

  
    public function resetPassword(Request $request, $pd_reset_token)
    {
        if ($request->isMethod('post')) {

            $change = array();
            $change['password'] = $request->input('password');
            $change['confirmpassword'] = Hash::make($request->input('confirmpassword'));

            $admin = new Admin();

            $result = DB::table('users')->where('pd_reset_token', $pd_reset_token)->update(['password' => $change['confirmpassword'], 'pd_reset_token' => ""]);

            return redirect('/admin/login');
            if ($result) {

                return view('Admin::admin/login')->with('status', 'password sucessfuly changed');
            }
        }
        return view('Admin::admin/resetpassword');
    }

 


    public function myProfile(Request $request)
    {
        return view('Admin::admin/myProfile', ['data' => Session::get('admin')]);
    }

  
   
   

    public function changePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'password' => 'required|min:6',
                'newpassword' => 'required|min:6',
                'confirmpassword' => 'required|min:6',
            ];
            $message = [
                'password.required' => 'enter current password',
                'newpassword.required' => 'enter new password',
                'confirmpassword.required' => 'enter Conform New Password is same as New Password',

            ];

            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                return back()->WithErrors($validator)->WithInput();
            }
            $oldpassword = $request->input('password');
            $newpassword = $request->input('newpassword');
            $confirmpassword = $request->input('confirmpassword');
            $result = DB::table('users')->where('id', Auth::id())->first();
            $changepassword = $result->password;

            if (Hash::check($oldpassword, $changepassword)) {
                if ($newpassword != $confirmpassword) {
                    return json_encode(['status' => 'Password Changed Successfully']);
                }
                $change = array();
                $change['password'] = Hash::make($request->input('confirmpassword'));
                $objectmodeluser = new Admin();
                $result = $objectmodeluser->userPasswordChange($change);
                if ($result) {
                    return back()->with('status', 'Password Changed Successfully');

                    return json_encode(['status' => 200]);
                }


            }
            return back()->with('error', 'Old password must be same with current password');

        }
        return view('Admin::admin/changePassword');

    }


    
    public function lock(Request $request)
    {
        return view('Admin::admin/lock');

    }


    public function editAccount(Request $request, $id)
    {

        if ($request->isMethod('post')) {
            $rules = [
                'email' => 'required|email',
                'firstname' => 'required',
                'lastname' => 'required',
            ];
            $message = [
                'email.required' => 'enter a correct email',
                'firstname.required' => 'enter your first name',
                'lastname.required' => 'enter your last name',

            ];

            $validator = validator::make($request->input(), $rules, $message);
            if ($validator->fails()) {
                
                return back()->WithErrors($validator)->WithInput();
            } else

            $firstname = $request->all()['firstname'];
            $lastname = $request->all()['lastname'];
            $email = $request->all()['email'];
            $username = $request->all()['username'];
            $result = DB::table('users')->whereId($id)->update(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'username' => $username]);
            if ($result) {
                Session::put('admin.username',$username);
                return back()->with('status', ' Profile Updated successfully');
            }
        }
        $result = DB::table('users')->whereId($id)->first();
        return view('Admin::admin/edit', ['result' => $result]);


    }


}



