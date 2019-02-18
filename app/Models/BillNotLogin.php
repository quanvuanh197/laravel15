<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillNotLogin extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'not_login_bills';
    protected $fillable = ['total','tax','name','email','address','phone','code'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}