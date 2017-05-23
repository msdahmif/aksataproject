<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangeRequestController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('change-request.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        return view('change-request.show');
    }

}
