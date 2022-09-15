<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class GeneralController extends Controller{

    /**
     * authenticate a newly user .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        return view('home');
    }

}