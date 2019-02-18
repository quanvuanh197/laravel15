<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Admin;
use Hash;
use Yajra\Datatables\Datatables;

class AdminsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function formAdminActive(){
        return view('admin/admins/admin_active');
    }

    public function getAdminActive(){
        $admins = Admin::where('active',1)->orderBy('id','Desc');

        return Datatables::of($admins)
        ->addColumn('action', function($admin){
            return 
            '<a type="button" class="btn btn-info btn-show" title="Detail" data-toggle="tooltip" id="post-detail" data-url="'.asset('/admin/admins/find').'/'.$admin->id.'"><span class="fa fa-eye"></span></a>

            <a type="button" class="btn btn-success btn-edit" title="Edit" data-toggle="tooltip" data-url="'.asset('/admin/admins/find').'/'.$admin->id.'" id="post-edit"><span class="fa fa-edit" ></span></a>

            <a type="button" class="btn btn-warning btn-deactivate" title="Deactivate" data-toggle="tooltip" id="post-delete" data-id="'.$admin->id.'"><span class="fa fa-lock"></span></a>';
        })

        ->rawColumns(['action'])
        ->toJson();
        
    }

    public function formAdminInactive(){
        return view('admin/admins/admin_inactive');
    }

    public function getAdminInactive(){
        $admins = Admin::where('active',0)->orderBy('id','Desc');

        return Datatables::of($admins)
        ->addColumn('action', function($admin){
            return 
            '<a type="button" class="btn btn-info btn-show" title="Detail" data-toggle="tooltip" id="post-delete" data-url="'.asset('/admin/admins/find').'/'. $admin->id.'"><span class="fa fa-eye"></span></a>

            <a type="button" class="btn btn-success btn-active" title="Active" data-toggle="tooltip" id="post-delete" data-id="'.$admin->id.'"><span class="fa fa-unlock"></span></a>

            <a type="button" class="btn btn-danger btn-delete" title="Delete" data-toggle="tooltip" id="post-delete" data-id="'.$admin->id.'"><span class="fa fa-times"></span></a>';
        })

        ->rawColumns(['action'])
        ->toJson();
    }

    public function store(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_name' => 'required',
            'email' => 'required|email',
            'password'=> 'required|min:6',
            'password_confirm'=> 'required|same:password',
            'phone'=> 'min:10|max:11',
        ]);


        if ($validator->passes()) {
            $data_request = $request->all();
            $result = $this->checkMail($data_request['email']);
            if ($result == 'fail') {
                return response()->json(['error_email'=> 'Email already exists!']);
            }
            $data_request['password'] = md5($data_request['password']);
            if ($request->image!=Null) {
                $original_name = $request->image->getClientOriginalName();
                $file = $request->image->storeAs('/img_user',$original_name,'public');
                $data_request['image'] = $file;
            } else {
                unset($data_request['image']);
            }
            $data_request['active'] = 1;

            Admin::create($data_request);
            return response()->json(['success'=>'Added new records.']);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function checkMail($email){
        $result = Admin::where('email',$email)->first();
        if ($result) {
            return 'fail';
        } else {
            return 'success';
        }
    }

    public function find($id){
        $admin = Admin::where('id',$id)->firstOrFail();

        if ($admin['gender']==0) {
            $admin['gender-sub'] = 'Male';
        } else {
            $admin['gender-sub'] = 'Female';
        }

        if ($admin['active']==0) {
            $admin['active-sub'] = 'Inactive';
        } else {
            $admin['active-sub'] = 'Active';
        }

        return response()->json(['data'=>$admin],200);
    }

    public function update(Request $request,$id){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data_request = $request->all();

        if (isset($data_request['phone'])) {

            $validator = Validator::make($data_request, [
                'name' => 'required',
                'user_name' => 'required',
                'email' => 'required|email',
                'phone' => 'min:10|max:11',
            ]);   
        } else {
            unset($data_request['phone']);
            $validator = Validator::make($data_request, [
                'name' => 'required',
                'user_name' => 'required',
                'email' => 'required|email',
            ]);
        }

        if ($validator->passes()) {

            if ($request->image!=Null) {
               $original_name = $request->image->getClientOriginalName();
               $file = $request->image->storeAs('/img_user',$original_name,'public');
               $data_request['image'] = $file;
           } else {
            unset($data_request['image']);
        }

        Admin::where('id',$id)->update($data_request);
        return response()->json(['success'=>'Added new records.']);
        } else {
            return response()->json(['error'=>$validator->errors()->all()]);
        }  
    }
    public function active(Request $request,$id){

        Admin::where('id',$id)->update($request->all());

        return response()->json(['success'=>'ok']);
    }
    public function delete($id){
    Admin::where('id',$id)->delete();

    return response()->json(['success'=>'ok']);
}
}
