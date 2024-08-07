<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use DB;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-roles', ['only' => ['index','show','listdata']]);
        $this->middleware('permission:create-roles', ['only' => ['create','store']]);
        $this->middleware('permission:edit-roles', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-roles', ['only' => ['destroy']]);
    }

    //=================================================================
    public function index()
    {
        return view('roles.index');
    }

    //=================================================================
    public function listdata(){
        return Datatables::of(DB::table('roles')
        ->select(DB::raw('roles.*,count(role_has_permissions.role_id) as total'))
        ->leftjoin('role_has_permissions','role_has_permissions.role_id','=','roles.id')
        ->groupby('roles.id')
        ->orderby('roles.id','desc')
        ->get())->make(true);
    }

    //=================================================================
    public function create()
    {
        $data_permission = DB::table('permissions')
        ->select('permission_grub', DB::raw('COUNT(*) as permission'))
        ->groupBy('permission_grub')
        ->get();
        return view('roles.create',compact('data_permission'));
    }

    //=================================================================
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->input('nama')]);
        $role->syncPermissions($request->input('permission'));
        return redirect('roles')->with('status','Add data success!');
    }

    //=================================================================
    public function show($id)
    {
        //
    }

    //=================================================================
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = DB::table('permissions')
        ->select('permission_grub', DB::raw('COUNT(*) as permission'))
        ->groupBy('permission_grub')
        ->get();
        $rolePermissions = DB::table('role_has_permissions')->where('role_id',$id)->get();
        return view('roles.edit',compact('role','permission','rolePermissions'));
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->nama;
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect('roles')->with('status','Update data success!');
    }

    //=================================================================
    public function destroy($id)
    {
        $roles = Roles::find($id);
        $response = [];
        try {
            if($roles){
                $user = User::where('level', $id)->get();
                if($user->isEmpty() ){
                    $roles->delete();
                    $response['message'] = 'Data deleted.';
                    return response()->json($response, 200);
                }else {
                    $response['message'] = 'Error ';
                    return response()->json($response, 500);
                }
            }
        }catch (\Exception $e) {
            $response['message'] = 'Delete failed ' . $e->getMessage();
            return response()->json($response, 500);
        }

    }
}
