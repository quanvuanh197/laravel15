<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Size;
use App\Models\ProductSize;
use Yajra\Datatables\Datatables;

class SizesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    public function delete($id){
    	$check = Size::find($id)->products;
    	if (strlen($check)!=2) {
    		return response()->json(['error'=>'This size already had products!']);
    	} else {
    		Size::where('id',$id)->delete();
    		return response()->json(['success'=>'ok']);
    	}
    }

    public function update(Request $request, $id){
    	date_default_timezone_set('Asia/Ho_Chi_Minh');
		$validator = Validator::make($request->all(), [
			'size' => 'required',
        ]);
		$data_request = $request->all();
		
        if ($validator->passes()) {
        	$result = Size::where('size',$data_request['size'])->first();
        	if ($result) {
        		if ($result['id']!=$id) {
        			return response()->json(['error_size'=>'Size must unique!']);
        		}
        	}

        	Size::where('id',$id)->update($data_request);

        	return response()->json(['success'=>'ok']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function find($id){
    	$result = Size::where('id',$id)->firstOrFail();

    	return response()->json(['data'=>$result]);
    }

    public function store(Request $request){
    	date_default_timezone_set('Asia/Ho_Chi_Minh');

		$validator = Validator::make($request->all(), [
			'size' => 'required',
        ]);
		$data_request = $request->all();
		
        if ($validator->passes()) {
        	$result = Size::where('size',$request['size'])->first();
        	if ($result) {
        		return response()->json(['error_size'=>'Size must unique!']);
        	}

        	Size::create($data_request);

        	return response()->json(['success'=>'ok']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function formSize(){
        return view('admin/sizes/size');
    }

    public function getSize(){
        $sizes = Size::orderBy('id','desc');
        
        return Datatables::of($sizes)
        ->addColumn('action', function($size){
            return 
            '<a type="button" class="btn btn-success btn-edit" title="Edit" data-toggle="tooltip" data-url="'.asset('/admin/sizes/find').'/'.$size->id.'" id="post-edit"><span class="fa fa-edit" ></span></a>

            <a type="button" class="btn btn-danger btn-delete" title="Delete" data-toggle="tooltip" id="post-delete" data-url="'.asset('/admin/sizes').'/'.$size->id.'"><span class="fa fa-times"></span></a>';
        })

        ->rawColumns(['action'])
        ->toJson();
        
    }
}
