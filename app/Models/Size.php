<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Size extends Authenticatable
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sizes';
    protected $fillable = ['size'];


    public function products(){
        return $this->belongsToMany('App\Models\Product','product_size','size_id','product_id');
    }
}