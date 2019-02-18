<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillNotLoginDetail extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'not_login_bill_detail';
    protected $fillable = ['bill_id','product_id','quantity','size_id','name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}