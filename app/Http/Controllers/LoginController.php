<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use AuthenticatesUsers;

class LoginController extends Controller
{

    public function login(){
        return view('login');

    }

    public function check(Request $request){
    //   return $request ->input();

    //validate request
    $request->validate([
        'email'=>'required|email',
        'password'=>'required|min:5|max:20 '
    ]);
    $userInfo = DB::table('users')->where('email','=', $request->email)->first();

    if(!$userInfo){
        return back()->with('fail','We do not recognize your email address');
    }else{
        //check password
        if(Hash::check($request->password, $userInfo->password)){
            $request->session()->put('LoggedUser', $userInfo->id);
            return redirect('/manageproduct');

        }else{
            return back()->with('fail','Incorrect password');
        }
    }
    }
    public function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }}
    public function product(){
        $data = ['LoggedUserInfo'=> DB::table('users')->where('id','=', session('LoggedUser'))->first()];
        return view('product', $data);
    }

    
}
 