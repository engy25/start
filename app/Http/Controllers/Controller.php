<?php

namespace App\Http\Controllers;

//use Illuminate\Foundation \Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\validation\ValidatesRequests;
use Illuminate\Http\Request ;

class Controller extends BaseController
{
   // use AuthorizesRequests,
   use  DispatchesJobs;
   use ValidatesRequests;
}
