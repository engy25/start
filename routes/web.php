<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Relations\RelationsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
define('PAGINATION_COUNT',4);
Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {

  return 'Not adualt';
}) -> name('not.adult');

Auth::routes(['verify' =>true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('fill', [App\Http\Controllers\CrudController::class, 'getOffers']);



Route::prefix('offers')->group(function () {
  Route::get('/create', [App\Http\Controllers\CrudController::class, 'create']);
   Route::post('/store', [App\Http\Controllers\CrudController::class, 'storrr'])->name('offers.store');
   Route::get('/all', [App\Http\Controllers\CrudController::class, 'allgetoffer'])->name('offers.all');
   Route::get('/youtube', [App\Http\Controllers\CrudController::class, 'getVideo']);
   Route::get('edit/{offer_id}',  [App\Http\Controllers\CrudController::class, 'editOffer']);
   Route::post('update/{offer_id}', 'CrudController@UpdateOffer')->name('offers.update');
   Route::get('delete/{offer_id}',  [App\Http\Controllers\CrudController::class, 'delete'])->name('offers.delete');
   Route::get('get-all-inactive-offers', [App\Http\Controllers\CrudController::class, 'getAllInActiveOffers']);
   
  
   Route::get('get-all-inactive-Invalid-offers', [App\Http\Controllers\CrudController::class, 'getAllInActiveInvalidOffers']);

 

   //  Route::prefix('ar')->group(function (){
 
 //Route::get('/create', [App\Http\Controllers\CrudController::class, 'create']);
   // }
 

    });

////////////////// ajax routes  /////////////


Route::group(['prefix' =>'ajax-offers'],function(){

  Route::get('create',[App\Http\Controllers\OfferController::class, 'create']);
  Route::Post('store',[App\Http\Controllers\OfferController::class, 'store'])->name('ajax.offers.store');


 
});


////////////////// ajax routes  /////////////

/////begin  authentication and guards////

Route::group(['middleware' => 'CheckAge'], function () {
  Route::get('adults',[App\Http\Controllers\Auth\CustomAuthController::class, 'adult'])-> name('adult');
});

Route::get('site',[App\Http\Controllers\Auth\CustomAuthController::class, 'site'])->middleware('auth:web')-> name('site');
Route::get('admin',[App\Http\Controllers\Auth\CustomAuthController::class, 'admin'])->middleware('auth:admin')-> name('admin');

Route::get('admin/login',[App\Http\Controllers\Auth\CustomAuthController::class, 'adminLogin'])-> name('admin.login');
Route::post('admin/login',[App\Http\Controllers\Auth\CustomAuthController::class, 'checkAdminLogin'])-> name('save.admin.login');
///// end of authentication and guards////

//////begin relation routes one-to-one  ////

//\App\User::where('id',24);
Route::get('has-one',[App\Http\Controllers\Relations\RelationsController::class, 'hasOneRelation']);

Route::get('has-one-reverse',[App\Http\Controllers\Relations\RelationsController::class, 'hasOneRelationReverse']);

Route::get('get-user-has-phone',[App\Http\Controllers\Relations\RelationsController::class, 'getUserHasPhone']);



Route::get('get-user-has-not-phone',[App\Http\Controllers\Relations\RelationsController::class, 'getUserHasNotPhone']);


/////// relation one-to-one route end /////



//////begin relation routes one-to-many  ////

Route::get('hospital-has-doctor',[App\Http\Controllers\Relations\RelationsController::class, 'hospitalHasDoctor']);

Route::get('hospitals',[App\Http\Controllers\Relations\RelationsController::class, 'hospitals'])->name('hospitals.all');

Route::get('doctors/{hospital_id}',[App\Http\Controllers\Relations\RelationsController::class, 'doctors'])->name('hospital.doctors');
Route::get('hospitals/{hospital_id}',[App\Http\Controllers\Relations\RelationsController::class, 'deletehospital'])->name('hospital.delete');
Route::get('hospitals-has-doctors',[App\Http\Controllers\Relations\RelationsController::class, 'hospitalsHasDoctors']);
Route::get('hospitals-has-doctors-male',[App\Http\Controllers\Relations\RelationsController::class, 'hospitalsHasDoctorsMale']);
Route::get('hospitals-not-has-doctors-male',[App\Http\Controllers\Relations\RelationsController::class, 'hospitalsNotHasDoctorsMale']);
//////begin relation routes one-to-many  ////


//////begin relation routes many-to-many  ////
Route::get('doctors-services',[App\Http\Controllers\Relations\RelationsController::class, 'getDoctorServices'])->name('doctors.services');
Route::get('service-doctors',[App\Http\Controllers\Relations\RelationsController::class, 'getServiceDoctors'])->name('services.doctors');
Route::get('service/{doctor_id}',[App\Http\Controllers\Relations\RelationsController::class, 'getservice'])->name('hospitals.doctors.service');
Route::post('save_service-to_doctor',[App\Http\Controllers\Relations\RelationsController::class, 'saveServiceToDoctor'])->name('save.doctors.services');;
//////end relation routes many-to-many  ////
//////begin relation routes has one through  ////

Route::get('has-one-through',[App\Http\Controllers\Relations\RelationsController::class, 'getPatientDoctors']);

Route::get('has-many-through',[App\Http\Controllers\Relations\RelationsController::class, 'getCountryDoctors']);
//////end relation routes has one through  ////

//////begin Accessors and Mutators ////
Route::get('accessors',[App\Http\Controllers\Relations\RelationsController::class, 'getDoctors']);

//////end Accessors and Mutators ////


//////////////-> collection->>>>>>>>>>>>>>>>>>>>>       
Route::get('collection', [App\Http\Controllers\CollectTutController::class, 'index']);

    /// collection --->each
Route::get('collection-each', [App\Http\Controllers\CollectTutController::class, 'complex']);
Route::get('collection-filter', [App\Http\Controllers\CollectTutController::class, 'complexFilter']);
Route::get('collection-transform', [App\Http\Controllers\CollectTutController::class, 'complexTransform']);
Route::get('collection-transform2', [App\Http\Controllers\CollectTutController::class, 'complexTransform2']);

// there are the same route but in controller crud
//Route::get('maincats', [App\Http\Controllers\CollectTut::class, 'complex']);
//////////////-> collection->>>>>>>>>>>>>>>>>>>>>    
