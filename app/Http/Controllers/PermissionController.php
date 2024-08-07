<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-permission', ['only' => ['index','show','listdata']]);
        $this->middleware('permission:create-permission', ['only' => ['create','store']]);
        $this->middleware('permission:edit-permission', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-permission', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('permission.index');
    }

    public function listdata(){
        return Datatables::of(DB::table('permissions')->orderby('id','desc')->get())->make(true);
    }

    public function store(Request $request)
    {
        DB::table('permissions')
        ->insert([
            'name'=>$request->permission,
            'permission_grub'=>$request->permission_grub,
            'guard_name'=>'web'
        ]);
        return redirect('/permission');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = DB::table('permissions')->where('id',$id)->get();
        return $data;
    }

    public function update(Request $request, $id)
    {
        DB::table('permissions')
        ->where('id',$id)
        ->update([
            'name'=>$request->permission,
            'permission_grub'=>$request->permission_grub,
        ]);
        return redirect('/permission');
    }

    public function destroy($id)
    {
        DB::table('permissions')->where('id',$id)->delete();
    }


}
