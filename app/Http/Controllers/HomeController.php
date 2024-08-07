<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //===============================================================================
    public function index()
    {
        $user = User::count();
        $employee = Employee::count();
        return view('home', compact('user','employee'));
    }

    //===============================================================================
    public function editprofile()
    {
        $data = DB::table('users')->where('id',Auth::user()->id)->get();
        return view('user.editprofile',compact('data'));
    }

    public function aksieditprofile(Request $request)
    {
        if($request->password!=''){

            $usr = User::where('id',Auth::user()->id)->first();
            if (!Hash::check($request->oldpassword, $usr->password)){
                return redirect('home')->with('error','Password Lama Salah');
            } else {
                $usr->update([
                    'name' => $request->nama,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password'=>Hash::make($request->password),
                ]);
            }
        }else{
            User::where('id',Auth::user()->id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,

                ]);
        }
        return redirect('home')->with('status','Sukses memperbarui profile');
    }
   
}
