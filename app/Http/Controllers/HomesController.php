<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;


class HomesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
       $rate = \Swap::latest('EUR/JPY');
       $rate2 = \Swap::latest('EUR/USD');

       $ratio=$rate->getValue();
       $ratio2=$rate2->getValue();
       $jpn_eur=1/$ratio;
       $usd_eur=1/$ratio2;
       $jpn_usd=(1/$ratio)*$ratio2;



       
        return view('welcome',compact('ratio','rate2','ratio','ratio2','jpn_eur','usd_eur','jpn_usd'));
    }
    
   
   }