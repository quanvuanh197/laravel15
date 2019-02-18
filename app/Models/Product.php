<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Product extends Authenticatable
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'products';
    protected $fillable = ['name','info','color','sale_price','price','slug','code','description','creator_id','last_update_id','status','image','brand_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'remember_token',
    ];

    public function admin(){
    	return $this->belongsTo('App\Models\Admin');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    public function images(){
        return $this->hasMany('App\Models\ProductImage','product_id');
    }

    public function sizes(){
        return $this->belongsToMany('App\Models\Size','product_size','product_id','size_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag','product_tag','product_id','tag_id');
    }
}