<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermsAndCondition extends Model
{

    use SoftDeletes ;
    protected $fillable = [
        'title' ,
        'description'
    ];

    protected $hidden = [
        'deleted_at'
    ];
    
   
}
