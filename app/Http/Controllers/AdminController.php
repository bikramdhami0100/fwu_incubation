<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $validate=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
       
     $admin=Admin::where("email",'bikramdhami334@gmail.com')->first();
        if($admin){
            // if(Hash::check($password,$admin->password)){
            //     Session::put('admin',$admin);
            //     return redirect()->route('admin.dashboard');
            // }else{
            //     return redirect()->back()->with('error','Invalid Credentials');
            // }
            if($password==$admin->password){
                Session::put('admin',$admin);
                Session::put('admin_id',$admin->id);
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->back()->with('error','Invalid Credentials');
            }
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }

    }
}
