<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Tag;
use App\Models\ProductTag;
use Yajra\Datatables\Datatables;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    public function delete($id){
    	$check = Tag::find($id)->products;
    	if (strlen($check)!=2) {
    		ProductTag::where('tag_id',$id)->delete();
    	}

    	Tag::where('id',$id)->delete();

    	return response()->json(['success'=>'ok']);
    }

    public function update(Request $request, $id){
    	date_default_timezone_set('Asia/Ho_Chi_Minh');
		$validator = Validator::make($request->all(), [
			'tag' => 'required',
        ]);
		$data_request = $request->all();
		
        if ($validator->passes()) {
        	$data_request['slug'] = str_slug($data_request['tag']);
        	$result = Tag::where('slug',$data_request['slug'])->first();
        	if ($result) {
        		if ($result['id']!=$id) {
        			return response()->json(['error_slug'=>'Tag must unique!']);
        		}
        	}

        	Tag::where('id',$id)->update($data_request);

        	return response()->json(['success'=>'ok']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function find($id){
    	$result = Tag::where('id',$id)->firstOrFail();

    	return response()->json(['data'=>$result]);
    }

    public function store(Request $request){
    	date_default_timezone_set('Asia/Ho_Chi_Minh');

		$validator = Validator::make($request->all(), [
			'tag' => 'required',
        ]);
		$data_request = $request->all();
		
        if ($validator->passes()) {
        	$data_request['slug'] = str_slug($data_request['tag']);
        	$result = Tag::where('slug',$request['slug'])->first();
        	if ($result) {
        		return response()->json(['error_slug'=>'Tag must unique!']);
        	}

        	Tag::create($data_request);

        	return response()->json(['success'=>'ok']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function formTag(){
        return view('admin/tags/tag');
    }

    public function getTag(){
        $tags = Tag::orderBy('id','desc');
        
        return Datatables::of($tags)
        ->addColumn('action', function($tag){
            return 
            '<a type="button" class="btn btn-success btn-edit" title="Edit" data-toggle="tooltip" data-url="'.asset('/admin/tags/find').'/'.$tag->id.'" id="post-edit"><span class="fa fa-edit" ></span></a>

            <a type="button" class="btn btn-danger btn-delete" title="Delete" data-toggle="tooltip" id="post-delete" data-url="'.asset('/admin/tags').'/'.$tag->id.'"><span class="fa fa-times"></span></a>';
        })

        ->rawColumns(['action'])
        ->toJson();
        
    }
}
