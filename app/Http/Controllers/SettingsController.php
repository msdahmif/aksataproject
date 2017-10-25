<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
            return back()
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
}
