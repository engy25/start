<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table= "patients";
    protected $fillable=['name','age'];
    public $timestamps=false;


                     
     ####################### Begin relations################
     public function doctor()
     {
         return $this->hasOneThrough('App\Models\Doctor','App\Models\Medical','patient_id','medical_id','id','id');

     }
    
}
