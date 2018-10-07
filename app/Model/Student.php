<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
      protected $fillable = [
        'auth_id', 'email', 'name','address','mobile'
    ];
}
