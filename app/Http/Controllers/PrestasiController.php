<?php

namespace App\Http\Controllers;

use App\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * PrestasiController constructor.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('prestasi.index');
    }

    /**
     * @param Prestasi $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Prestasi $prestasi){
        return view('prestasi.show', compact('prestasi'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('prestasi.create');
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($request){
        //store to database

        return redirect('prestasi');
    }

    /**
     * @param Prestasi $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Prestasi $prestasi){
        // render the models here
        return view('prestasi.edit', compact('prestasi'));
    }

    /**
     * @param $request
     * @param Prestasi $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($request, Prestasi $prestasi){
        // store back and update the models here
        return redirect('prestasi/'.$prestasi->id);
    }
}
