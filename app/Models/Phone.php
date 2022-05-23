<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Phone extends Model
{
    use HasFactory;
    protected $table= "phones";
    protected $fillable=['code','phone'];
    protected $hidden=['user_id'];
    public $timestamps=false;


                     
     ####################### Begin relations################
     public function user()
     {
         return $this ->belongsTo('App\Models\User','user_id');
     }


         ///######################End relations################

}
