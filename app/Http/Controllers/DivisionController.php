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

class DivisionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
        // check if current user is allowed to create
        if (Auth::guest() || !(Auth::user()->role == 'admin'))
        {
            return abort(404, 'You are not allowed to perform this action.');
        }

        $super = Division::findOrFail($id);

        return view('management.division.create')->with(['super' => $super, 'title' => 'Aksata 2.0: Create New Management']);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
        // check if current user is allowed to edit
        if (Auth::guest() || !(Auth::user()->role == 'admin'))
        {
            return abort(404, 'You are not allowed to perform this action.');
        }

        $super = Division::findOrFail($id);
        $management = $super->management()->get()->first();

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
                'nim_ketua' => Request::input($valueKey),
                'id_kepengurusan' => $management->id
            ]));
        }

        $validator = Validator::make(
        	Request::all(),
		    $rules
		);
		
		if ($validator->fails())
		{
	        return redirect('division/'. $id .'/create')
	            ->withErrors($validator);
		}

       	$super->divisions()->saveMany($temp);

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
		//
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
