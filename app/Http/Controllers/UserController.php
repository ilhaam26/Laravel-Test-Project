<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use File;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-users', ['only' => ['index','show','listdata']]);
        $this->middleware('permission:create-users', ['only' => ['create','store']]);
        $this->middleware('permission:edit-users', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-users', ['only' => ['destroy']]);
    }

    //=================================================================
    public function index()
    {
        return view('user.index');
    }

    //=================================================================
    public function listdata(){
        return Datatables::of(
            DB::table('users')
            ->select(DB::raw('users.*,roles.name as levelnama'))
            ->leftjoin('roles','roles.id','=','users.level')
            ->orderby('users.id', 'asc')
            ->get())->make(true);
    }

    //=================================================================
    public function create()
    {
        $roles = DB::table('roles')->orderby('id','desc')->get();
        return view('user.create',compact('roles'));
    }

    //=================================================================
    public function store(Request $request)
    {
        $newlevel = explode('-',$request->level);
        $request->validate([
            'nama'=> 'required',
            'username'=> 'required|min:3|unique:users',
            'email'=> 'required|min:5|email|unique:users,email',
            'userpassword' => 'required',
            'kpassword' => 'required|same:userpassword'
        ]);
        $usr = User::create([
            'name'=>$request->nama,
            'username'=>$request->username,
            'email'=>$request->email,
            'level'=>$newlevel[0],
            'password' => Hash::make($request->userpassword)

        ]);
        $usr->assignRole($newlevel[1]);

        return redirect('/users')->with('status','Add data success!');
    }

    public function edit($id)
    {
        $data = User::where('id',$id)->get();
        $roles = DB::table('roles')->orderby('id','desc')->get();

        return view('user.edit',['data'=>$data,'roles'=>$roles]);
    }

    public function update(Request $request, $id)
    {
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $newlevel = explode('-',$request->level);
        $request->validate([
            'nama'=> 'required',
            'username'=> ['required','min:3',
                Rule::unique('users','username')->where(function ($query) use ($request, $id) {
                    return $query->where('username', $request->username)->where('id','!=',$id);
                })],
            'email'=> [
                'required',
                'email',
                Rule::unique('users','email')->where(function ($query) use ($request, $id) {
                    return $query->where('email', $request->email)->where('id','!=',$id);
                })
            ],
        ]);
        if($request->userpassword!=''){
            $usr = User::where('id',$id)->first();
                $usr->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'level'=>$newlevel[0],
                    'password'=>Hash::make($request->userpassword),
                ]);
                $usr = User::find($id);
                $usr->assignRole($newlevel[1]);
        }else{

            $usr = User::where('id',$id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'level'=>$newlevel[0],
                ]);
            $usr = User::find($id);
            $usr->assignRole($newlevel[1]);
        }
        return redirect('/users')->with('status','Update data success');
    }
    public function resetPassword(Request $request)
    {
        $user = User::find($request->id);

        $user->update([
            'password' => Hash::make($request->password),
            // 'updated_who' => Auth::user()->name
        ]);

        return redirect('/users')->with('status','Change password success');
    }

    //=================================================================
    public function destroy($id)
    {
        User::destroy($id);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    }
}
