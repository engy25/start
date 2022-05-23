<?php

namespace App\Http\Controllers;
use App\views\ajaxoffers;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;




class OfferController extends Controller
{
    //add 
    //delete 
    //edit

    use offerTrait;
    public function create()
    {
        //view form  to add this offer 
        return view('ajaxoffers.create');
    }

    public function store(OfferRequest $request)
    {
         //save offer into DB using AJAX

         $file_name = $this->saveImage($request->photo, 'images/offers');
         //insert  table offers in database
         $offer = Offer::create([
          'photo' => $file_name,
             'name' => $request->name,
             
             'price' => $request->price,
             'details' => $request->details,
 
         ]);
         if($offer)
 return response() -> json([
     'status' =>'true',
     'msg' =>'saved succesfully',
 ]);
     else

     return response() -> json([
        'status' =>'false',
        'msg' =>' not not saved succesfully',
    ]);

    
    }
    

 



}