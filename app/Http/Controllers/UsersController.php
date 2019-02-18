<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Hash;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
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


    public function formUserActive(){
        return view('admin/users/user_active');
    }

    public function getUserActive(){
        $users = User::where('active',1)->orderBy('id','Desc');

        return Datatables::of($users)
        ->addColumn('action', function($user){
            return 
            '<a type="button" class="btn btn-info btn-show-user" title="Detail" data-toggle="tooltip" id="post-detail" data-url="'.asset('/admin/users/find').'/'.$user->id.'"><span class="fa fa-eye"></span></a>

            <a type="button" class="btn btn-success btn-edit-user" title="Edit" data-toggle="tooltip" data-url="'.asset('/admin/users/find').'/'. $user->id.'" id="post-edit"><span class="fa fa-edit" ></span></a>


            <a type="button" class="btn btn-warning btn-deactivate-user" title="Deactivate" data-toggle="tooltip" id="post-delete" data-id="'.$user->id.'"><span class="fa fa-lock"></span></a>';
        })

        ->rawColumns(['action'])
        ->toJson();
    }

    public function formUserInactive(){
        return view('admin/users/user_inactive');
    }

    public function getUserInactive(){
        $users = User::where('active',0)->orderBy('id','Desc');

        return Datatables::of($users)
        ->addColumn('action', function($user){
            return 
            '<a type="button" class="btn btn-info btn-show-userinactive" title="Detail" data-toggle="tooltip" id="post-delete" data-url="'.asset('/admin/users/find').'/'. $user->id.'"><span class="fa fa-eye"></span></a>

            <a type="button" class="btn btn-success btn-active" title="Active" data-toggle="tooltip" id="post-delete" data-id="'.$user->id.'"><span class="fa fa-unlock"></span></a>

            <a type="button" class="btn btn-danger btn-delete" title="Delete" data-toggle="tooltip" id="post-delete" data-id="'.$user->id.'"><span class="fa fa-times"></span></a>';
        })

        ->rawColumns(['action'])
        ->toJson();
    }

    public function active(Request $request,$id){

        User::where('id',$id)->update($request->all());

        return response()->json(['success'=>'ok']);
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

        User::where('id',$id)->update($data_request);
        return response()->json(['success'=>'Added new records.']);
    } else {
        return response()->json(['error'=>$validator->errors()->all()]);
    }  
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
        $data_request['password'] = md5($data_request['password']);
        if ($request->image!=Null) {
            $original_name = $request->image->getClientOriginalName();
            $file = $request->image->storeAs('/img_user',$original_name,'public');
            $data_request['image'] = $file;
        } else {
            unset($data_request['image']);
        }
        $data_request['active'] = 1;

        User::create($data_request);
        return response()->json(['success'=>'Added new records.']);
    }


    return response()->json(['error'=>$validator->errors()->all()]);
}

public function find($id){
    $user = User::where('id',$id)->firstOrFail();

    if ($user['gender']==0) {
        $user['gender-sub'] = 'Male';
    } else {
        $user['gender-sub'] = 'Female';
    }

    if ($user['active']==0) {
        $user['active-sub'] = 'Inactive';
    } else {
        $user['active-sub'] = 'Active';
    }

    return response()->json(['data'=>$user],200);
}

public function delete($id){
    User::where('id',$id)->delete();

    return response()->json(['success'=>'ok']);
}

public function passwordChange(Request $request,$id){

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $validator = Validator::make($request->all(), [
        'password'=> 'required|min:6',
        'password_confirm'=> 'required|same:password',

    ]);  

    $data_request = $request->all();

    if ($validator->passes()) {

        $data_request['password'] = bcrypt($data_request['password']);

        unset($data_request['password_confirm']);
        User::where('id',$id)->update($data_request);
        return response()->json(['success'=>'ok']);
    }

    return response()->json(['error'=>$validator->errors()->all()]);

}
}
