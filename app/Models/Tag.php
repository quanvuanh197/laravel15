<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tag extends Authenticatable
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tags';
    protected $fillable = ['tag','slug'];


    public function products(){
        return $this->belongsToMany('App\Models\Product','product_tag','tag_id','product_id');
    }
}