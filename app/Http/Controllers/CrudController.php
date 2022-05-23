<?php

namespace App\Http\Controllers;
use App\Models\Offer;
use App\Models\Video;
use Illuminate\Support\Facades\Validator;
use App\Traits\offerTrait;
use App\views\offers;
use App\Http\Requests\OfferRequest;
use Illuminate\Http\Request;
use App\Events\VideoView;
use App\Models\Scopes\OfferScope;
class CrudController extends Controller
{
    use offerTrait;
    
    public function __construct()
    {
        
    }

  public function getOffers()
    {
        //هات لي كل الكولمن بتاعتك 
      // return Offer::get();
       return Offer::select('id','name')->get();

    }
/*   public function store()
    {
        //to insert by the model create 

        Offer::create([
            
            'name' => 'Tayrr',
            'price' => 'Otwll',
            'details' => 'Develloper',
        ]);
       
    }
 */


   public function create()
   {
       return view('offers.create');
   }
 

      
    public function storrr(OfferRequest $request)
    {
       
       
      
        //  return $request;
        //validata date before insert 
        //insert 
        /*
        $validated =validator::make ($request->all(),[
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|max:20|numeric',
            'details' => 'required',
        ],[
            'name.required' =>__('messages.offernamerequired'),
            'price.required' => 'اكتب السعر',
            'name.max' => "الاسم لا يزيد عن 100",
        ]);
        if($validated->fails())
        {
            return redirect()->back()->withErrors($validated)->withInputs($request->all());
        }
        */

/*
        //save photo in folder
        $file_extention=$request ->photo ->getClientOriginalExtension();
        $file_name=time().'.'.$file_extention; //
        $path= 'images/offers';
        $request-> photo-> move($path,$file_name);
       // return 'okay';
       */


     $file_name= $this->saveImage($request->photo,'images/offers');
           //insert 

Offer::create([
    'photo' =>$file_name,
    'name' => $request->name,
    
    'price' => $request->price,
    'details' => $request->details
]);

return redirect()->back()->with(['success'=>'تم اضافه العرض بنجاح']);
      
    }

   
   
   /// public function getRules()
    //{
    //  return $rules=
      //  [
      //      'name' => 'required|max:100|unique:offers,name',
        //    'price' => 'required|max:20|numeric',
        //    'details' => 'required',
        //];
   // }
   /*
    public function getMessages()
    { return $messages=
        
            'name.required' => 'يجب عليك كتابه الاسم',
            'price.required' => 'اكتب السعر',
            'name.max' => "الاسم لا يزيد عن 100",
        ];

    }
*/
   public function allgetoffer()
   {
        //-->return collection
        ///**************************************************** */
/*
       $offers=Offer::select('id','name','price','details')->get();  
       return view('offers.all', compact('offers'));
*/
       /********************************************* */
        $offers=Offer::select('id','name','price','details')->paginate(PAGINATION_COUNT);  
       // return view('offers.all', compact('offers'));
       return view('paginations', compact('offers'));
   }


   public function getVideo()
   {
      $video= Video::first();
      event(new VideoView($video));   ////--->fire event
       return view('video')->with('video',$video);
   }




   public function UpdateOffer(OfferRequest $request, $offer_id)
   {
       //validtion

       // chek if offer exists

       $offer = Offer::find($offer_id);
       if (!$offer)
           return redirect()->back();

       //update data

       $offer->update($request->all());

       return redirect()->back()->with(['success' => ' تم التحديث بنجاح ']);

       /*  $offer->update([
             'name_ar' => $request->name_ar,
             'name_en' => $request->name_en,
             'price' => $request->price,
         ]);*/

   }



   public function editOffer($offer_id)
    {
        // Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id);  // search in given table id only
        if (!$offer)
            return redirect()->back();

        $offer = Offer::select('id', 'name', 'details','price')->find($offer_id);

        return view('offers.edit', compact('offer'));

    }
    public function delete($offer_id)
    {
        // check if offer id exist
        $offer=offer::find($offer_id);
        if(!$offer)
        {
            return redirect() ->back() ->with(['error' =>'offer not found']);
        }
        $offer ->delete();
        return redirect()->route('offers.all') ->with(['success'=>'offer deleted successfully']);

    }

    public function getAllInActiveOffers()
    {
        // here i'am using elequent mot query builder beacause it contains many advantages like relation
        // where whereNull whereNotNull WhereIn
      return $inactiveOffers= Offer::InActive()->get(); ///-> all inactive offers

    }
    public function getAllInActiveInvalidOffers()
    {
        //global scope
       // return Offer::Invalid()->get();

        //to remove the gobal scope
        return Offer:: withoutGlobalScope(OfferScope::class)->get();

    }


 



    
}
