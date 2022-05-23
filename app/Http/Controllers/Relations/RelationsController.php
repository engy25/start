<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Phone;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Country;
use App\Models\Service;
use views\doctors\hospitals;

class RelationsController extends Controller
{
    //one to one//
    public function hasOneRelation()
    {
        /*
        //to bring data of user
        $User=User::with('Phone')->find(24);
       // $User->Phone;
     //  $Phone=$User->Phone;
        //to bring all data
        return response() ->json($User);

*/
/*
$user = User::with(['Phone'=>function($q)
{
    $q->select('code','phone','user_id');
}])->find(24);

        $Phone=$user->Phone;
        return response() ->json($user);

*/


$user = User::with(['Phone'=>function($q)
{
    $q->select('code','phone','user_id');
}])->find(24);

      // return $user->Phone->code;  //---> print 02
      return $user->name; 
        return response() ->json($user);


    }

    public function hasOneRelationReverse()
    {
     // return $phone= Phone::find(1);
     
     // visible  --- in model وانت عايز ترجعها لو فيه حاجه مخفيه

     /*
     //make some attribute visible
    $phone= Phone::find(1);
     $phone->makeVisible(['user_id']);
     return $phone;

    }
    */
    /*
    //make some attribute hidden
    $phone= Phone::find(1);
    $phone->makeHidden(['phone']);
    return $phone;
    */
    $phone= Phone::with('User')->find(1);
    $phone->makeVisible(['user_id']);
     return $phone; ///return user of this phone number
     //get all data phone+ user


}

/// user have phone only
public function getUserHasPhone()
{
    //$user = 
   
    return User::whereHas('Phone',function($q)
    {
        $q->where('code','02');
    })->get();
}

public function getUserHasNotPhone()
    {
        return User::whereDoesntHave('phone')->get();
    }


    //one to many relationship//
    public function hospitalHasDoctor()
    {
        /*
        $hospital=Hospital::with('doctors')->find(1);
        $doctors =$hospital->doctors;
        foreach($doctors  as $doctor)
        {
             echo $doctor->name.'<br>';
        }
       // return $hospital;  //-->return hospital doc
       */
      
     $doctor= Doctor::with('Hospital')->find(2);
     return  $doctor->hospital;
    }
    public function hospitals()
    {
        $hospitals=Hospital::select('id','name','address')->get();
        return view('doctors.hospitals',compact('hospitals'));
    }

    public function doctors($hospital_id)
    {
        $hospital=Hospital::find($hospital_id);
        $doctors =$hospital->doctors; 
        return view('doctors.doctors',compact('doctors'));
    }
//get all hospital which has doctors
    public function hospitalsHasDoctors()
    {
     return $Hospitals=Hospital::whereHas('doctors')->get();
    }

    public function hospitalsHasDoctorsMale()
    {
      return $Hospitals=Hospital::with('doctors')->whereHas('doctors', function($q)
       {
           $q->where('gender',1);
       })->get();


    }
    public function hospitalsNotHasDoctorsMale()
    {
        return $Hospitals=Hospital::whereDoesntHave('doctors')->get();
    }

    public function deletehospital($hospital_id)
    {
        $Hospital=Hospital::find($hospital_id);
        if(!$Hospital)
       
            return abort('404');
            //delete doctors in this hospitals
            $Hospital->doctors()->delete();
            $Hospital->delete();
            return redirect()->route('hospitals.all');

    }

    public function getDoctorServices()
    {
       $doctor=Doctor::with('services')->find(1);
         return $doctor->services;


    }
    public function getServiceDoctors()
    {
       $doctor=Service::with('doctors')->find(1);
       return $doctor->services;


    }

    public function getservice($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        $services= $doctor->services; //->doc service with id


        //all doctors 
       $doctors= Doctor::select('id','name')->get();
       $allServices= Service::select('id','name')->get();  // all doc service
        return view('doctors.services',compact('services','doctors','allServices'));

    }
    public function saveServiceToDoctor(Request $request)
    {
    $doctor = Doctor::find($request->doctor_id);
    if(!$doctor)
    return abort('404');
    //the difference between sync and attach
    //$doctor->services()->attach($request -> servicesIds);
    //$doctor->services()->sync($request -> servicesIds);
    $doctor->services()->syncWithoutDetaching($request -> servicesIds);
    return 'success';

    }


    ///////has one through//////////
    public function getPatientDoctors()
    {
       $patient= Patient::find(1);
       return $patient->doctor;
    }
    public function getCountryDoctors()
    {
        
    
        return $country= Country::find(1);       
      
    } 
public function getDoctors()
{
    return $doctors= Doctor::select('id','name','gender')->get();
    /*
   if(isset($doctors) && $doctors->count() >0)
   {
   foreach($doctors as $doctor)
   {
    $doctor->gender =$doctor->gender==1 ? 'male':'female';
   }
   }
   return $doctors;
}
*/

}


}