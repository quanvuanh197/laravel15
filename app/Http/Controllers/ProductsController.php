<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\Datatables;
use Auth;
use Storage;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Tag;
use App\Models\ProductSize;
use App\Models\ProductTag;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    public function updateSizes(Request $request,$id){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data_request = $request->all();

        $validator = Validator::make($request->all(), [
            '39'=> 'numeric',
            '40'=> 'numeric',
            '41'=> 'numeric',
            '42'=> 'numeric',
            '43'=> 'numeric',
            '44'=> 'numeric',
            '45'=> 'numeric',
            '46'=> 'numeric',
            '47'=> 'numeric',
            '48'=> 'numeric',
            '49'=> 'numeric',
        ]);

        if ($validator->passes()) {
            $product_current = Product::where('id',$id)->firstOrFail();
            $product_current_code = $product_current['code'];
            $sizes = Size::get();
            foreach ($sizes as $size) {
                $size_datas[$size['size']] = $size;
            }
            ProductSize::where('product_id',$id)->delete();
            foreach ($size_datas as $key => $size_data) {
                if ($data_request[$key]!=null) {
                    $status['status'] = 1;
                    $status['last_update_id'] = Auth::guard('admin')->user()->id;
                    Product::where('id',$id)->update($status);
                    $data_request_size['size_id'] = $size_data['id'];
                    $data_request_size['product_id'] = $id;
                    $data_request_size['quantity'] = $data_request[$key];
                    $data_request_size['product_size_code'] = $product_current_code.'0'.$key;

                    ProductSize::create($data_request_size);
                    unset($data_request[$key]);
                } else {
                    unset($data_request[$key]);
                }
            }
            return response()->json(['success'=>'ok']);
        }
           
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function updateImages(Request $request,$id){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data_request = $request->all();
        $product_code = Product::where('id',$id)->firstOrFail()->code;
        $data_images = ProductImage::where('product_id',$id)->get();
        $image_sort = "";
        foreach ($data_images as $value) {
            $slide1 = explode('/', $value['image']);
            $slide2 = explode('_', $slide1[1]);
            $slide3 = explode('.', $slide2[1]);
            if ($image_sort <= $slide3[0]) {
                $image_sort = $slide3[0];
            }     
        }

        if ($data_request['images_update']) {
            $images_update_array = explode(",",$data_request['images_update']);
            $count_update = $image_sort;
            foreach ($images_update_array as $value) {
                if ($data_request['image-edit-single-'.$value]) {
                    $count_update++;
                    $image_name = ProductImage::where('id',$value)->firstOrFail()->image;
                    $slide_name = explode("/", $image_name);
                    $file_name = $slide_name[1];

                    $result = Storage::delete('public/img_product/'.$file_name);

                    $original_name = $data_request['image-edit-single-'.$value]->getClientOriginalName();
                    $image_name = explode(".", $original_name); 
                
                    $length_image_name = count($image_name);

                    $type_image = $image_name[$length_image_name-1];

                    $file_name = $product_code.'_'.$count_update.'.'.$type_image;

                    $file = $data_request['image-edit-single-'.$value]->storeAs('/img_product',$file_name,'public');

                    $data_request_product_image_update['product_id'] = $id;
                    $data_request_product_image_update['image'] = $file;
                    ProductImage::where('id',$value)->delete();
                    ProductImage::create($data_request_product_image_update);
                }
            }
        }


        if ($data_request['images_delete']) {
            $images_delete_array = explode(",",$data_request['images_delete']);
            
            foreach ($images_delete_array as $value) {
                    $image_name = ProductImage::where('id',$value)->firstOrFail()->image;
                    $slide_name = explode("/", $image_name);
                    $file_name = $slide_name[1];

                    $result = Storage::delete('public/img_product/'.$file_name);
                    
                    ProductImage::where('id',$value)->delete();  
            }
        }

        

        if ($request->product_images_edit!=Null) {
            if (isset($count_update)) {
                $count_add = $count_update;
            } else {
                $count_add = $image_sort;
            }
            
            foreach ($request->product_images_edit as $product_image) {
                $count_add++;
                $original_name_product_image = $product_image->getClientOriginalName();

                $image_name_product_image = explode(".", $original_name_product_image); 

                $length_product_image = count($image_name_product_image);

                $type_image_product_image = $image_name_product_image[$length_product_image-1];

                $file_name_product_image = $product_code.'_'.$count_add.'.'.$type_image_product_image;

                $file_product_image = $product_image->storeAs('/img_product',$file_name_product_image,'public');

                $data_request_product_image['product_id'] = $id;
                $data_request_product_image['image'] = $file_product_image;
                
                ProductImage::create($data_request_product_image);
            }

        }

        $data_request_user['last_update_id'] = Auth::guard('admin')->user()->id;
        Product::where('id',$id)->update($data_request_user);
        return response()->json(['success'=>'Updated records.']);
    }

    public function update(Request $request,$id){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data_request = $request->all();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
        ]);

        if ($validator->passes()) {

            $data_request['slug'] = str_slug($data_request['name']);
            $data_request['last_update_id'] = Auth::guard('admin')->user()->id;

            $product_current = Product::where('slug',$data_request['slug'])->first();
            
            if (isset($product_current)) {
                if ($id!=$product_current['id']&&$data_request['slug']==$product_current['slug']){
                    return response()->json(['error_slug'=>'Name already exesist!']);
                }
            }
            
            $product_current_id = $id;
            $product_current = Product::where('id',$id)->first();
            $product_current_code = $product_current['code'];

            if ($request->image!=Null) {
                $original_name = $request->image->getClientOriginalName();
                $image_name = explode(".", $original_name); 
                
                $length_image_name = count($image_name);

                $type_image = $image_name[$length_image_name-1];

                if ($product_current['image']) {
                    Storage::delete('public/'.$product_current['image']);
                    $file_name = $product_current_code.date("YmdHis").'.'.$type_image;
                } else {
                    $file_name = $product_current_code.'.'.$type_image;
                }
            
                $file = $request->image->storeAs('/img_product',$file_name,'public');
                
                $data_request['image'] = $file;
                
            } else {
                unset($data_request['image']);
            }
            
            $data_tags = $data_request['tags'];

            unset($data_request['tags']);

            Product::where('id',$id)->update($data_request);

            if ($data_tags) {
                $tags_array = explode(",",$data_tags);
                ProductTag::where('product_id',$id)->delete();
                foreach ($tags_array as $tag) {
                    $slug_tag = str_slug($tag);
                    $tag_check = Tag::where('slug',$slug_tag)->first();
                    if (!$tag_check) {
                        $tag_request['tag'] = $tag;
                        $tag_request['slug'] = $slug_tag;
                        Tag::create($tag_request);
                    }
                    $tag_slug_database = Tag::where('slug',$slug_tag)->firstOrFail();
                    $product_tag_request['tag_id'] = $tag_slug_database['id'];
                    $product_tag_request['product_id'] = $id; 
                    ProductTag::create($product_tag_request);
                }
            }

            return response()->json(['success'=>'Updated records.']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function formProductStock(){
        return view('admin/products/in_stock');

        $products = Product::get();

        foreach ($products as $value) {
            $check = Product::find($value['id'])->sizes;
            if (strlen($check)==2) {
                $check = null;
            }
            if ($check) {
                $status['status'] = 1;
                Product::where('id',$value['id'])->update($status);
            } else {
                $status['status'] = 0;
                Product::where('id',$value['id'])->update($status);
            }
        }
    }

    public function getProductStock(){
        $products = Product::where('status',1)->orderBy('id','desc');

        return Datatables::of($products)
        ->editColumn('sale_price', function($product) {
            return number_format($product->sale_price);
        })
        ->editColumn('color', function($product) {
            if ($product->color) {
                return '<div class="color-product" style="background-color: '.$product->color.';"></div>';
            } else {
                return 'Unknown';
            }
            
        })
        ->editColumn('image', function($product) {
            if ($product->image) {
                return '<img class="image-product" src='.asset('storage').'/'.$product->image.'>';
            } else {
                return '<img class="image-product" src="https://i.vimeocdn.com/portrait/1274237_300x300">';
            }
            
        })
        ->editColumn('brand_id', function($product) {
            if ($product->brand_id) {
                $name = Brand::where('id',$product->brand_id)->first()->name;

                return $name;
            } else {
                return 'Unknown';
            }
        })
        ->addColumn('action', function($product){
            return 
            '<a type="button" class="btn btn-info btn-show" title="Detail" data-toggle="tooltip" id="post-detail" data-url="'.asset('/admin/products/find').'/'.$product->id.'"><span class="fa fa-eye"></span></a>

            <a type="button" class="btn btn-success btn-edit" title="Edit" data-toggle="tooltip" id="post-edit" data-url="'.asset('/admin/products/findproduct').'/'.$product->id.'" brand-url="'.asset('/admin/products/brandsall').'"><span class="fa fa-edit" ></span></a>

            <a type="button" class="btn btn-primary btn-edit-quantity" title="Quantity Edit" data-toggle="tooltip" id="post-edit" data-url="'.asset('/admin/products/findsize').'/'.$product->id.'" size-url="'.asset('/admin/products/sizesall').'" product_id='.$product->id.'><span class="fa fa-list-ol" ></span></a>

            <a type="button" class="btn btn-warning btn-edit-image" title="Images Edit" data-toggle="tooltip" id="post-edit" data-url="'.asset('/admin/products/findimage').'/'.$product->id.'"><span class="fa fa-image" ></span></a>

            <a type="button" class="btn btn-danger btn-delete-product" title="Delete" data-toggle="tooltip" id="post-edit" data-url="'.asset('/admin/products').'/'.$product->id.'"><span class="fa fa-times" ></span></a>';
            })

        ->rawColumns(['action','color','image'])
        ->toJson();
    }

    public function delete($id){
        
        $images = ProductImage::where('product_id',$id)->get();

        if (strlen($images)!=2) {
            foreach ($images as $value) {
                Storage::delete('public/'.$value['image']);
            }
        }
       
        ProductImage::where('product_id',$id)->delete();
        
        if (strlen(Product::find($id)->sizes)!=2) {
            ProductSize::where('product_id',$id)->delete();
        }

        if (strlen(Product::find($id)->tags)!=2) {
            ProductTag::where('product_id',$id)->delete();
        }
        Product::where('id',$id)->delete();
        return response()->json(['success'=>'Added new records.']);
    }

    public function formProductOutStock(){     
        return view('admin/products/out_of_stock');

        $products = Product::get();

        foreach ($products as $value) {
            $check = Product::find($value['id'])->sizes;
            if (strlen($check)==2) {
                $check = null;
            }
            if ($check) {
                $status['status'] = 1;
                Product::where('id',$value['id'])->update($status);
            } else {
                $status['status'] = 0;
                Product::where('id',$value['id'])->update($status);
            }
        }
    }

    public function getProductOutStock(){
        $products = Product::where('status',0)->orderBy('id','desc');

        return Datatables::of($products)
        ->editColumn('sale_price', function($product) {
            return number_format($product->sale_price);
        })
        ->editColumn('color', function($product) {
            if ($product->color) {
                return '<div class="color-product" style="background-color: '.$product->color.';"></div>';
            } else {
                return 'Unknown';
            }
            
        })
        ->editColumn('image', function($product) {
            if ($product->image) {
                return '<img class="image-product" src='.asset('storage').'/'.$product->image.'>';
            } else {
                return '<img class="image-product" src="https://i.vimeocdn.com/portrait/1274237_300x300">';
            }
            
        })
        ->editColumn('brand_id', function($product) {
            if ($product->brand_id) {
                $name = Brand::where('id',$product->brand_id)->first()->name;

                return $name;
            } else {
                return 'Unknown';
            }
        })
        ->addColumn('action', function($product){
            return 
            '<a type="button" class="btn btn-info btn-show" title="Detail" data-toggle="tooltip" id="post-detail" data-url="'.asset('/admin/products/find').'/'.$product->id.'"><span class="fa fa-eye"></span></a>

            <a type="button" class="btn btn-success btn-edit" title="Edit" data-toggle="tooltip" id="post-edit" data-url="'.asset('/admin/products/findproduct').'/'.$product->id.'" brand-url="'.asset('/admin/products/brandsall').'"><span class="fa fa-edit" ></span></a>

            <a type="button" class="btn btn-primary btn-edit-quantity" title="Quantity Edit" data-toggle="tooltip" id="post-edit" data-url="'.asset('/admin/products/findsize').'/'.$product->id.'" size-url="'.asset('/admin/products/sizesall').'" product_id='.$product->id.'><span class="fa fa-list-ol" ></span></a>


            <a type="button" class="btn btn-warning btn-edit-image" title="Images Edit" data-toggle="tooltip" id="post-edit" data-url="'.asset('/admin/products/findimage').'/'.$product->id.'"><span class="fa fa-image" ></span></a>

            <a type="button" class="btn btn-danger btn-delete-product" title="Delete" data-toggle="tooltip" id="post-edit" data-url="'.asset('/admin/products').'/'.$product->id.'"><span class="fa fa-times" ></span></a>';
        })

        ->rawColumns(['action','color','image'])
        ->toJson();
    }

    public function findImage($id){
        $images = ProductImage::where('product_id',$id)->get();
        $product_id = Product::where('id',$id)->firstOrFail()->id;
        $length_images = strlen($images);
        $data['images'] = $images;
        $data['product_id'] = $product_id;
        return response()->json(['data'=>$data]);
    }

    public function findSize($id){
        $sizes = ProductSize::where('product_id',$id)->get();
        $length_sizes = strlen($sizes);

        if ($length_sizes!=2) {
            foreach ($sizes as $size) {
                $size_data[$size['size_id']] = $size;
            }
            $data['sizes'] = $size_data;
            return response()->json(['data'=>$data]);
        }
        
    }

    public function store(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data_request = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            '39'=> 'numeric',
            '40'=> 'numeric',
            '41'=> 'numeric',
            '42'=> 'numeric',
            '43'=> 'numeric',
            '44'=> 'numeric',
            '45'=> 'numeric',
            '46'=> 'numeric',
            '47'=> 'numeric',
            '48'=> 'numeric',
            '49'=> 'numeric',
        ]);

        if ($validator->passes()) {

            $data_request['slug'] = str_slug($data_request['name']);

            $words = explode(" ", $data_request['name']); 
            $acronym = ""; 

            foreach ($words as $w) { 
                $acronym .= $w[0]; 
            }

            $up_case_acronym = strtoupper($acronym);

            $time_now = date("YmdHis");
            $data_request['code'] = $up_case_acronym.$time_now;
            $data_request['creator_id'] = Auth::guard('admin')->user()->id;
            $data_request['last_update_id'] = Auth::guard('admin')->user()->id;

            if ($request->image!=Null) {
                $original_name = $request->image->getClientOriginalName();
                $image_name = explode(".", $original_name); 

                $length_image_name = count($image_name);

                $type_image = $image_name[$length_image_name-1];

                $file_name = $data_request['code'].'.'.$type_image;

                $file = $request->image->storeAs('/img_product',$file_name,'public');

                $data_request['image'] = $file;

            } else {
                unset($data_request['image']);
            }

            Product::create($data_request);
            $product_current = Product::where('slug',$data_request['slug'])->firstOrFail();
            $product_current_id = $product_current['id'];
            $product_current_code = $product_current['code'];

            if ($data_request['tags']) {
                $tags_array = explode(",",$data_request['tags']);
                foreach ($tags_array as $tag) {
                    $slug_tag = str_slug($tag);
                    $tag_check = Tag::where('slug',$slug_tag)->first();
                    if (!$tag_check) {
                        $tag_request['tag'] = $tag;
                        $tag_request['slug'] = $slug_tag;
                        Tag::create($tag_request);
                    }
                    $tag_slug_database = Tag::where('slug',$slug_tag)->firstOrFail();
                    $product_tag_request['tag_id'] = $tag_slug_database['id'];
                    $product_tag_request['product_id'] = $product_current_id;
                    ProductTag::create($product_tag_request);
                }
            }

            if ($request->product_images!=Null) {

                $count = "";

                foreach ($request->product_images as $product_image) {
                    $count++;

                    $original_name_product_image = $product_image->getClientOriginalName();

                    $image_name_product_image = explode(".", $original_name_product_image); 

                    $length_product_image = count($image_name_product_image);

                    $type_image_product_image = $image_name_product_image[$length_product_image-1];

                    $file_name_product_image = $data_request['code'].'_'.$count.'.'.$type_image_product_image;

                    $file_product_image = $product_image->storeAs('/img_product',$file_name_product_image,'public');

                    $data_request_product_image['product_id'] = $product_current_id;
                    $data_request_product_image['image'] = $file_product_image;

                    ProductImage::create($data_request_product_image);
                }

            }

            $sizes = Size::get();
            foreach ($sizes as $size) {
                $size_datas[$size['size']] = $size;
            }

            foreach ($size_datas as $key => $size_data) {
                if ($data_request[$key]!=null) {
                    $status['status'] = 1;
                    Product::where('id',$product_current_id)->update($status);
                    $data_request_size['size_id'] = $size_data['id'];
                    $data_request_size['product_id'] = $product_current_id;
                    $data_request_size['quantity'] = $data_request[$key];
                    $data_request_size['product_size_code'] = $product_current_code.'0'.$key;

                    ProductSize::create($data_request_size);
                }
            }

            return response()->json(['success'=>'Added new records.']);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function getBrandsName(){
        $name = Product::find(1)->brand;
        dd($name);
    }

    public function getAllBrands(){
        $brands = Brand::get();
        foreach ($brands as $brand) {
            $brands_data[] = $brand;
        }

        return response()->json(['brands_data'=>$brands_data]);
    }

    public function getAllSizes(){
        $sizes = Size::get();
        foreach ($sizes as $size) {
            $sizes_data[$size['size']] = $size;
        }

        return response()->json(['sizes_data'=>$sizes_data]);
    }

    public function findProduct($id){
        $product = Product::where('id',$id)->firstOrFail();
        $product['price_format'] = number_format($product['price']);
        $product['sale_price_format'] = number_format($product['sale_price']);
        if ($product['brand_id']) {
            $product['brand'] = Brand::where('id',$product->brand_id)->first()->name;
        } else {
            $product['brand'] = 'Unknown';
        }

        $tags = ProductTag::where('product_id',$id)->get();
        $length_tags = strlen($tags);

        if ($length_tags!=2) {
            foreach ($tags as $tag) {
                $tag_names = Tag::where('id',$tag['tag_id'])->get();
                foreach ($tag_names as $tag_name) {
                    $tag['tag_name'] = $tag_name['tag'];
                }
            }
        }
        $data['product'] = $product;
                $data['tags'] = $tags;
        foreach ($data as $key => $value) {
            if (strlen($value)==2) {
                unset($data[$key]);
            }
        }

        return response()->json(['data'=>$data]);
    }

    public function find($id){

        $product = Product::where('id',$id)->firstOrFail();
        $product['price_format'] = number_format($product['price']);
        $product['sale_price_format'] = number_format($product['sale_price']);
        if ($product['brand_id']) {
            $product['brand'] = Brand::where('id',$product->brand_id)->first()->name;
        } else {
            $product['brand'] = 'Unknown';
        }

        $tags = ProductTag::where('product_id',$id)->get();
        $length_tags = strlen($tags);

        if ($length_tags!=2) {
            foreach ($tags as $tag) {
                $tag_names = Tag::where('id',$tag['tag_id'])->get();
                foreach ($tag_names as $tag_name) {
                    $tag['tag_name'] = $tag_name['tag'];
                }
            }
        }
        $images = ProductImage::where('product_id',$id)->get();
        $length_images = strlen($images);

        $sizes = ProductSize::where('product_id',$id)->get();
        $length_sizes = strlen($sizes);

        if ($length_sizes!=2) {
            foreach ($sizes as $size) {
                $size_names = Size::where('id',$size['size_id'])->get();
                foreach ($size_names as $size_name) {
                    $size['size_name'] = $size_name['size'];
                }
            }
        }

        $data['product'] = $product;
        $data['tags'] = $tags;
        $data['images'] = $images;
        $data['sizes'] = $sizes;

        foreach ($data as $key => $value) {
            if (strlen($value)==2) {
                unset($data[$key]);
            }
        }

        return response()->json(['data'=>$data]);

        }

}
