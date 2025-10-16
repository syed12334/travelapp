<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_faq extends Model
{
     protected $table = 'property_faqs';
     protected $fillable =[
        'property_id',
        'question',
        'answer'
    ];
     public $timestamps = false;
}
