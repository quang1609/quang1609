<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function getLogin(){
        return view('admin.users.login',['title'=>'Hệ thống đăng nhập']);
    }
    public function postLogin(Request $request){
        $this->validate($request,[
            'email'=>'required|email:filter',
            'password'=>'required'
        ],[
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập mật khẩu'
        ]);        
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'level'=> 1 ],$request->remember )){
            return redirect('admin/main');
        }   
        else{
            return redirect('login')->with('thongbao','Đăng nhập thất bại');
        }
        
    }
}
