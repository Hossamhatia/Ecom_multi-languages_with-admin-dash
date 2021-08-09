<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Session;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Admin;

class DashBoardController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/admin/Auth/login';
    public function __construct()
    {
        $this->middleware('guest',['except'=>'logout']);
    }
    public function dash()
    {
        return view('admin.dashboard');
    }
    public function getLogin()
    {
        return view('admin.auth.login');
    }
    public function postLogin(Request  $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
           $user = auth()->guard('admin')->user();
            //\Session::put('success','you are login Successfully!!');
            return redirect()->route('dashboard',compact('user'));
        }else{
            return back()->with('error','your user name or password are inncorrect');
        }
    }
    public function logout()
    {
        auth()->gurad('admin')->logout();
       // \Session::flush();
       // \Session::put('success','you are LogedOut Successfuly!!');
        return redirect(route('adminLogin'));
    }
}
