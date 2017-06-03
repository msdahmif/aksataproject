<?php

namespace App\Http\Controllers;

use App\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * AchievementController constructor.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($nim = Auth::user()->nim){
        $achievements = Achievement::where('user_nim', $nim)->get();

        return view('achievement.index', compact('achievements'));
    }

    /**
     * @param Achievement $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Achievement $achievement){
        return view('achievement.show', compact('achievement'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('achievement.create');
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($request){
        //store to database

        return redirect('achievement');
    }

    /**
     * @param Achievement $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Achievement $achievement){
        // render the models here
        return view('achievement.edit', compact('achievement'));
    }

    /**
     * @param $request
     * @param Achievement $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($request, Achievement $achievement){
        // store back and update the models here
        return redirect('achievement/'. $achievement->id);
    }
}
