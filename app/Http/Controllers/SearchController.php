<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Profile;
use Carbon\Carbon;
use Request;
use stdClass;

class SearchController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $q = Request::input('q', '');
        $result = $this->search($q);

		return view('search', ['q' => $q, 'result' => $result]);
	}

    /**
     * Filter $profiles according to the search query $q
     *
     * @param $profiles
     * @param $q
     * @return mixed
     */
    public function search($_q)
    {
        // split $q
//        $q = explode(" \r\t\n`!@#$%^&*()-=_+{}[]\\|;:'\",./<>?", strtolower($_q));
        $e = explode(" ", strtolower(str_replace(" \r\t\n`!@#$%^&*()-=_+{}[]\\|;:'\",./<>?", " ", $_q)));
        $q = array_filter($e);

        // if $q is empty, return an empty array
        if (!count($q)) return [];

        // iterate through each profile, check if they match the query
        $profiles = Profile::get();
        $result = [];
        foreach ($profiles as $profile)
        {
            //filter each profile according to the current user
            $profile->filter();

            $exist = array_pad([], count($q), false);
            $count = 0;

            foreach (array_merge(Profile::$singleValued, Profile::$multiValued) as $key)
            {
                if (!$profile->$key) continue;

                $value = $profile->$key;
                // handle for date
                if ($value instanceof Carbon)
                {
                    $value = $value->formatLocalized('%e %B %Y');
                }
                // handle for object (composite)
                else if ($value instanceof stdClass)
                {
                    $serialized = '';
                    foreach ($value as $innerValue)
                    {
                        $serialized .= $innerValue . '|';
                    }
                    $value = $serialized;
                }
                // handle for multi-valued
                else if (is_array($value))
                {
                    $serialized = '';
                    foreach ($value as $innerValue)
                    {
                        if (!$innerValue) continue;
                        $serialized .= $innerValue->value . '|';
                    }
                    $value = $serialized;
                }

                // find occurrence of each string
                $value = strtolower($value);
                for ($i = 0; $i < count($q); $i++)
                {
                    if (strpos($value, $q[$i]) !== false && !$exist[$i])
                    {
                        $exist[$i] = true;
                        $count++;
                        if ($count == count($q)) break;
                    }
                }

                if ($count == count($q)) break;
            }

            if ($count == count($q))
            {
                array_push($result, $profile);
            }
        }

        return $result;
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
