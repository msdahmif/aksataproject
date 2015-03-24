<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if (Auth::guest())
        {
            return abort(404, 'You are not allowed to perform this action');
        }

		return view('settings', ['user' => Auth::user()]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update(Request $request)
	{
        if (Auth::guest())
        {
            return abort(404, 'You are not allowed to perform this action');
        }

        $user = Auth::user();

        // check old password
        if (!Auth::validate(['nim' => $user->nim, 'password' => $request->input('old_password', '')]))
        {
            return Redirect::back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'password' => 'These credentials do not match our records.'
                ]);
        }

        // validate the user input
        $this->validate($request, [
            'email' => 'required|email',
            'new_password' => 'confirmed',
            'new_password_confirmation' => 'same:new_password'
        ]);

        // update the newly entered data
        $user->update([
            'email' => $request->input('email')
        ]);

        if ($request->has('new_password') && count($request->input('new_password')))
        {
            $user->update([
                'password' => bcrypt($request->input('new_password'))
            ]);
        }
        $user->save();

        return view('settings', ['user' => $user]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
