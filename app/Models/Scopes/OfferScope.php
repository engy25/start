<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class OfferScope implements Scope
{
    use HasFactory;
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('status',0)->whereNull('details');
    }

    // ->register gilbal scope

    
      

}
