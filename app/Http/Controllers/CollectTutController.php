<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class CollectTutController extends Controller
{
    //
    public function index()
    {
        /*
        $number=[1,2,3,4];
        $col= collect($number);
        return $col->avg();
        */
        /*
        $name=collect(['ahmed',25]);
        return $name->combine(['name','age']);
*/
/*
        $name=collect(['ahmed',25,'ahmed',5,1,1,1]);
        return $name->countBy();
        */

        $name=collect(['ahmed',25,'ahmed',5,1,1,1]);
        return $name->duplicates();



        //each   filter     search            transform

    }

       
public function complex()
{
    $Patients= Patient::get();
    $Patients=collect($Patients);
    //remove --> collection
    $Patients->each(function($Patient)
    {
       // if($offer->status==0){
        unset($Patient->age);
       // }
      
       
        return $Patient;
        
    });
    return $Patients;
}



    public function complexFilter()
    {
        $patients= Patient::get();
        $patients=collect($patients);
        $filtered=$patients->filter(function($value,$key)
    {
        return $value['id']==3;
    });
    return array_values($filtered->all());
    }

    public function complexTransform()
    {
        $patients= Patient::get();
        $patients=collect($patients);
        $transform=$patients->transform(function($value,$key)
    {
        return 'name is'. $value['name'];
    });
    return array_values($transform->all());

    }

    public function complexTransform2()
    {
        $patients= Patient::get();
        $patients=collect($patients);
       return $transform=$patients->transform(function($value,$key)
    {
       $data=[];
        $data['name']=$value['name'];
        $data['age']=25;
        return $data;
    });
   

    }
}
