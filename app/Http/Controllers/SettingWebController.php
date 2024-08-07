<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use File;
use DB;

class SettingWebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:setting-web', ['only' => ['index','store']]);
    }

    //=================================================================
    public function index()
    {
        $data = DB::table('setting_web')->orderby('id','desc')->limit(1)->get();
        return view('settingweb.index',compact('data'));
    }

    //=================================================================
    public function store(Request $request)
    {
        if($request->hasFile('app_logo')){
            File::delete('images/setting/'.$request->old_logo);
            $extension = $request->file('app_logo')->extension();
            $nameland=$request->file('app_logo')->getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('images/setting/');

            $img = Image::make($request->file('app_logo')->path());
            $img->resize(500, null, function ($const) {
                $const->aspectRatio();
            })->save($destination.'/'.$finalname);
            
            DB::table('setting_web')
            ->where('id',$request->kode)
            ->update([
                'app_name'=>$request->app_name,
                'app_alias'=>$request->app_alias,
                'app_logo'=>$finalname,
                'sidebar_type'=>$request->sidebar_type,
                'navbar_color'=>$request->navbar_color,
                'logo_bg_color'=>$request->brand_logo_bg_color,
                'navbar_type'=>$request->navbar_type,
                'brand_type'=>$request->brand_type,
                'sidebar_mode'=>$request->sidebar_mode,
            ]);
        }else{
            DB::table('setting_web')
            ->where('id',$request->kode)
            ->update([
                'app_name'=>$request->app_name,
                'app_alias'=>$request->app_alias,
                'sidebar_type'=>$request->sidebar_type,
                'navbar_color'=>$request->navbar_color,
                'logo_bg_color'=>$request->brand_logo_bg_color,
                'navbar_type'=>$request->navbar_type,
                'brand_type'=>$request->brand_type,
                'sidebar_mode'=>$request->sidebar_mode,
            ]);
        }
        return redirect('setting-web')->with('status','Setting saved');
    }

    
}
