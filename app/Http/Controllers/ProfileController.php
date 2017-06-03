<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Profile;
use App\User;
use Request;
use Redirect;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ProfileController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // redirect to root if current user is a guest
        if (Auth::guest())
        {
            return redirect('/');
        }

        // return own profile
        return $this->show(Auth::user()->nim);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
		// not necessary for now
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(){
	    // not necessary for now
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string   $nim
	 * @return Response
	 */
	public function show($nim)
	{
        $profile = Profile::where('user_nim', $nim);

        if ($profile == null){
            return abort(404, "The profile you are looking for doesn't exist");
        }

        $profile->filter();

        return view('profile.view')->with(['profile' => $profile, 'title' => 'Aksata: Profile']);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string   $nim
	 * @return Response
	 */
	public function edit($nim = null)
	{
        // replace nim with current login user if it is null
        if ($nim == null && Auth::check()){
            $nim = Auth::user()->nim;
        }

        // check if current user is allowed to edit
        if (Auth::guest() || !Auth::user()->isAllowedToEdit($nim)){
            return abort(404, 'You are not allowed to perform this action.');
        }

        // the corresponding profile
        $profile = Profile::find($nim);
        $profile->filter();

        return view('profile.edit')->with(['profile' => $profile, 'title' => 'Aksata: Edit Profile']);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  string $nim
     * @return Response
     */
	public function update($nim = null)
	{
        $oldnim = $nim;

        // replace nim with current login user if it is null
        if ($nim == null && Auth::check()) {
            $nim = Auth::user()->nim;
        }

        // check if current user is allowed to edit
        if ($nim == null || Auth::guest() || !Auth::user()->isAllowedToEdit($nim))
        {
            return abort(404, 'You are not allowed to perform this action.');
        }

        // process user's input
        $data = ['hak_lihat' => new stdClass()];

        // multiValued
        foreach (Profile::$multiValued as $key)
        {
            $temp = [];
            $data['hak_lihat']->$key = [];

            for ($i = 1; ; $i++)
            {
                $labelKey = $key . '_label_' . $i;
                $valueKey = $key . '_value_' . $i;
                $hakLihatKey = 'hak_lihat_' . $key . '_' . $i;
                if (!Request::has($labelKey) || !Request::has($valueKey)) break;

                array_push($temp, [
                    'label' => Request::input($labelKey),
                    'value' => Request::input($valueKey)
                ]);
                array_push($data['hak_lihat']->$key, Request::input($hakLihatKey, 'private'));
            }
            $data[$key] = json_encode($temp);
        }

        // singleValued
        foreach (Profile::$singleValued as $key) {
            // composite
            if (in_array($key, Profile::$composite)) {
                $temp = [];
                foreach (Request::all() as $requestKey => $requestValue) {
                    if (substr($requestKey, 0, strlen($key)) == $key) {
                        $attrKey = substr($requestKey, strlen($key) + 1, strlen($requestKey));
                        $temp[$attrKey] = $requestValue;
                    }
                }
                $data[$key] = json_encode($temp);
            }

            // non-composite
            else {
                if (Request::has($key)) {
                    $data[$key] = Request::input($key);
                }
            }
            $hakLihatKey = 'hak_lihat_' . $key;
            $data['hak_lihat']->$key = Request::input($hakLihatKey, 'private');
        }

        // json_encode hak_lihat
        $data['hak_lihat'] = json_encode($data['hak_lihat']);

        // special for tanggal_lahir
        $data['tanggal_lahir'] = Carbon::createFromFormat('m/d/Y', $data['tanggal_lahir']);

        // upload file
        if (Request::hasFile('foto'))
        {
            $ext = '.' . Request::file('foto')->getClientOriginalExtension();
            $data['foto_url'] = 'foto/' . $nim . $ext;
            Request::file('foto')->move(public_path() . '/foto', $nim . $ext);
        }

        // update the profile
        $profile = Profile::find($nim);
        $profile->update($data);
        $profile->save();

        return Redirect('profile' . ($oldnim == null ? '' : '/' . $nim));
    }

    public function confirm($nim = null)
    {
        // replace nim with current login user if it is null
        if ($nim == null && Auth::check()){
            $nim = Auth::user()->nim;
        }

        // check if current user is allowed to edit
        if ($nim == null || Auth::guest() || !Auth::user()->isAllowedToEdit($nim)) {
            return abort(404, 'You are not allowed to perform this action.');
        }

        // save current profle
        $profile = Profile::find($nim);
        $profile->updated_at = Carbon::now();
        $profile->save();

        // redirect to the last page
        return Redirect::back();
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string   $nim
	 * @return Response
	 */
	public function destroy($nim){
		//
	}
}
