<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Brand extends Authenticatable
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'brands';
    protected $fillable = ['name','thumbnail','slug'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function products(){
    	return $this->hasMany('App\Models\Product','brand_id');
    }
}