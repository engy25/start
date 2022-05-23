<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Scopes\OfferScope;

class Offer extends Model
{
    use HasFactory;
    protected $table= "offers";
    protected $fillable=['name','photo','price','details','status','updated_at', 'created_at'];
    protected $hidden =['updated_at', 'created_at'];
    public $timestamps=false;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OfferScope);
    }
    public function scopeInActive($query)
    {
        return $query->where('status',0);

    }
    public function scopeInvalid($query)
    {
        return $query->where('status',0)->whereNull('details');
    }

    ///Mutators
    public function setNameAttribute($val)
    {
       return $this->attributes['name']=strtoupper($val);

        

    }


}
