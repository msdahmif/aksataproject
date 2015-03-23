<?php namespace App\Http\Controllers;

use App\Member;

class MemberController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
//		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}
    
	public function create()
	{
		return abort(404);
	}
	
    public function show($id)
    {
        $member = Member::find($id);

        if ($member == null)
        {
            return abort(404, "The member you are looking for doesn't exist");
        }

        return view('profile.view')->with(['member' => $member, 'title' => 'Aksata 2.0: Profile Page']);
    }
	
	public function edit($id)
	{
		return "edit " . $id;
	}
	
	public function update($id)
	{
		return "update " . $id;
	}
}
