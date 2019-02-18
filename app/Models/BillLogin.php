<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillLogin extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'login_bills';
    protected $fillable = ['user_id','total','tax','name','email','address','phone','code'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}