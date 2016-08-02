<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use App\Management;
use App\Division;
use App\Profile;
use App\User;
use Request;
use Redirect;
use Carbon;
use Auth;

class ManagementController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $management = Management::orderBy('tanggal_mulai', 'DESC')->get();
        $role = 'user';
	    if (Auth::check()) {
	    	$role = Auth::user()->role;
	    }

        return view('management.view')->with(['management' => $management, 'role' => $role, 'title' => 'Aksata 2.0: Management']);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        // check if current user is allowed to create
        if (Auth::guest() || !(Auth::user()->role == 'admin'))
        {
            return abort(404, 'You are not allowed to perform this action.');
        }

        return view('management.create')->with(['title' => 'Aksata 2.0: Create New Management']);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        // check if current user is allowed to edit
        if (Auth::guest() || !(Auth::user()->role == 'admin'))
        {
            return abort(404, 'You are not allowed to perform this action.');
        }

        // singleValued
        foreach (Management::$singleValued as $key)
        {
            // composite
            if (in_array($key, Management::$composite))
            {
                $temp = [];
                foreach (Request::all() as $requestKey => $requestValue)
                {
                    if (substr($requestKey, 0, strlen($key)) == $key)
                    {
                        $attrKey = substr($requestKey, strlen($key) + 1, strlen($requestKey));
                        $temp[$attrKey] = $requestValue;
                    }
                }
                $data[$key] = json_encode($temp);
            }
            // non-composite
            else
            {
                if (Request::has($key))
                {
                    $data[$key] = Request::input($key);
                }
            }
        }
    	
        // for tanggal
        $data['tanggal_mulai'] = Carbon::createFromFormat('m/d/Y', $data['tanggal_mulai']);

        // divisi
        $key = 'divisi';
        $temp = [];
        $rules = [];

        for ($i = 1; ; $i++)
        {
            $labelKey = $key . '_nama_' . $i;
            $valueKey = $key . '_nim_' . $i;
            if (!Request::has($labelKey) || !Request::has($valueKey)) break;

  			$rules[$labelKey] = 'required';
  			$rules[$valueKey] = 'required|exists:profiles,nim';

            array_push($temp, new Division([
                'nama' => Request::input($labelKey),
                'nim_ketua' => Request::input($valueKey)
            ]));
        }

        $rules['nama'] = 'required';
        $rules['nim_ketua'] = 'required|exists:profiles,nim';
        $rules['tanggal_mulai'] = 'required';

        $validator = Validator::make(
        	Request::all(),
		    $rules
		);
		
		if ($validator->fails())
		{
	        return redirect('management/create')
	            ->withInput(Request::only('nama', 'tanggal_mulai'))
	            ->withErrors($validator);
		}

        // buat kepengurusan sebelumnya selesai
        $last = Management::orderBy('tanggal_mulai', 'DESC')->get()->first();
        if (!empty($last)) {
	        $last->tanggal_selesai = $data['tanggal_mulai'];;
	        $last->save();

	        // buat ketua sebelumnya menjadi user
	        $lead = User::find($last->nim_ketua)->first();
	        $lead->role = 'user';
	        $lead->save();
        }

        // buat ketua sebagai admin
        $lead = User::find($data['nim_ketua'])->first();
        $lead->role = 'admin';
        $lead->save();

        // create the management
        $management = Management::create($data);
        $management->divisions()->saveMany($temp);

        return Redirect('management');
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
        // check if current user is allowed to edit
        if (Auth::guest() || !(Auth::user()->role == 'admin'))
        {
            return abort(404, 'You are not allowed to perform this action.');
        }

        $management = Management::findOrFail($id);

        return view('management.edit')->with(['management' => $management, 'title' => 'Aksata 2.0: Edit Management']);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update(Request $request)
	{

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
