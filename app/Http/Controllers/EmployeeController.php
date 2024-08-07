<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Province;
use App\Models\City;
use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use Google\Service\Drive\DriveFile;
use Image;
use File;
use Validator;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

/**
 * Class EmployeeController
 * @package App\Http\Controllers
 */
class EmployeeController extends Controller
{


     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('permission:view-employee', ['only' => ['index','show', 'listdata']]);
         $this->middleware('permission:create-employee', ['only' => ['create','store']]);
         $this->middleware('permission:edit-employee', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-employee', ['only' => ['destroy']]);
     }


    public function index(Request $request)
    {
       return view('employee.index');
    }

    
   public function listdata()
   {
       $data = Employee::select('id','first_name','last_name','email','phone_number','date_of_birth', 'current_position')
           ->orderBy('id', 'asc')
           ->get();

       return DataTables::of($data)->make(true);
   }

   public function getCities($provinceId)
    {
    $cities = City::where('province_id', $provinceId)->pluck('name', 'id');
    
    return response()->json($cities);
    }

    public function create()
    {
        $employee = new Employee();
        $positions = ['Manager','Supervisor','Staff','Intern','Others'];
        $provinces = Province::pluck('name', 'id');
        $banks = ['BCA','BRI','BNI','Mandiri','BTN'];
        return view('employee.create', compact('employee','positions','provinces','banks'));
    }

    private function getFileIdFromUrl($url)
    {
        $parsedUrl = parse_url($url);

        $queryParams = [];
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
        }

        return $queryParams['id'] ?? 'ID tidak ditemukan';
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'first_name'=>'required|string|min:3|max:255',
            'phone_number' => 'required|numeric|digits_between:9,13',
            'ktp_number' => 'required|numeric|digits:16',
            'email' => 'email',
            'date_of_birth' => 'date|before:today',
            'ktp_photo' => 'image'
        ]);
        if ($request->hasFile('ktp_photo')) {
            $file = $request->file('ktp_photo');
            $filePath = $file->getClientOriginalName();
            
            $disk = Storage::disk('google');
            $fileContents = file_get_contents($file);
            $disk->put($filePath, $fileContents);
            
            $ktpPhotoUrl = $disk->url($filePath);
        }

        $employee = Employee::create([
            'first_name' => $validateData['first_name'],
            'last_name' => $request->last_name,
            'phone_number' => $validateData['phone_number'],
            'email' => $validateData['email'],
            'date_of_birth' => $validateData['date_of_birth'],
            'ktp_number' => $validateData['ktp_number'],
            'ktp_photo' => $request->hasFile('ktp_photo') ? $ktpPhotoUrl : '',
            'province' => $request->province,
            'city' => $request->city,
            'street' => $request->street,
            'zip_code' => $request->zip_code,
            'current_position' => $request->current_position,
            'bank_account' => $request->bank_account,
            'bank_account_number' => $request->bank_account_number,
        ]);

            return redirect()->route('employee.index')
                ->with('success', 'Employee created successfully.');
        
    }


    public function show($id)
    {
        $employee = Employee::find($id);
        $province = Province::find($employee->province);
        $city = City::find($employee->city);
        $employee->created_at = Carbon::parse($employee->created_at)->timezone('Asia/Jakarta');
        $fileId = $this->getFileIdFromUrl($employee->ktp_photo);
        return view('employee.show', compact('employee','province','city','fileId'));
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        $positions = ['Manager','Supervisor','Staff','Intern','Others'];
        $provinces = Province::pluck('name', 'id');
        $banks = ['BCA','BRI','BNI','Mandiri','BTN'];
        $cities = City::where('province_id', $employee->province)->pluck('name', 'id');
        return view('employee.edit', compact('employee','provinces','positions','banks','cities'));
    }

    public function update(Request $request,$id)
    {
        $validateData = $request->validate([
            'first_name'=>'required|string|min:3|max:255',
            'phone_number' => 'required|numeric|digits_between:9,13',
            'ktp_number' => 'required|numeric|digits:16',
            'email' => 'email',
            'date_of_birth' => 'date|before:today',
            'ktp_photo' => 'image'
        ]);
        $employee = Employee::find($id);
        $ktpPhotoUrl = $employee->ktp_photo;
        if ($request->hasFile('ktp_photo')) {
            $file = $request->file('ktp_photo');
            $filePath = $file->getClientOriginalName();
            
            $disk = Storage::disk('google');
            $fileContents = file_get_contents($file);
            $disk->put($filePath, $fileContents);
            
            $ktpPhotoUrl = $disk->url($filePath);
        }
        $employee->update([
            'first_name' => $validateData['first_name'],
            'last_name' => $request->last_name,
            'phone_number' => $validateData['phone_number'],
            'email' => $validateData['email'],
            'date_of_birth' => $validateData['date_of_birth'],
            'ktp_number' => $validateData['ktp_number'],
            'ktp_photo' => $request->hasFile('ktp_photo') ? $ktpPhotoUrl : $employee->ktp_photo,
            'province' => $request->province,
            'city' => $request->city,
            'street' => $request->street,
            'zip_code' => $request->zip_code,
            'current_position' => $request->current_position,
            'bank_account' => $request->bank_account,
            'bank_account_number' => $request->bank_account_number,
        ]);

        return redirect()->route('employee.index')
            ->with('success', 'Employee updated successfully');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id)->delete();

        return redirect()->route('employee.index')
            ->with('success', 'Employee deleted successfully');
    }
}
