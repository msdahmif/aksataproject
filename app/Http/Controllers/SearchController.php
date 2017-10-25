<?php namespace App\Http\Controllers;

use App\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

class SearchController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        $q = $request->input('q', '');
        $result = $this->search($q);

		return view('search', ['q' => $q, 'result' => $result]);
	}

    /**
     * Filter $profiles according to the search query $q
     *
     * @return mixed
     * @internal param $q
     */
    private function search($_q)
    {
        // split $q
        $e = explode(" ", strtolower(str_replace(" \r\t\n`!@#$%^&*()-=_+{}[]\\|;:'\",./<>?", " ", $_q)));
        $q = array_filter($e);

        // if $q is empty, return an empty array
        if (!count($q)) return [];

        // iterate through each profile, check if they match the query

        // change to query scope
        $profiles = Profile::get();
        $result = [];
        foreach ($profiles as $profile) {
            //filter each profile according to the current user
            $profile->filter();

            $exist = array_pad([], count($q), false);
            $count = 0;

            foreach (array_merge(Profile::$singleValued, Profile::$multiValued) as $key) {
                if (!$profile->$key) continue;

                $value = $profile->$key;
                // handle for date
                if ($value instanceof Carbon) {
                    $value = $value->formatLocalized('%e %B %Y');
                } // handle for object (composite)
                else if ($value instanceof stdClass) {
                    $serialized = '';
                    foreach ($value as $innerValue) {
                        $serialized .= $innerValue . '|';
                    }
                    $value = $serialized;
                } // handle for multi-valued
                else if (is_array($value)) {
                    $serialized = '';
                    foreach ($value as $innerValue) {
                        if (!$innerValue) continue;
                        $serialized .= $innerValue->value . '|';
                    }
                    $value = $serialized;
                }

                // find occurrence of each string
                $value = strtolower($value);
                for ($i = 0; $i < count($q); $i++) {
                    if (strpos($value, $q[$i]) !== false && !$exist[$i]) {
                        $exist[$i] = true;
                        $count++;
                        if ($count == count($q)) break;
                    }
                }

                if ($count == count($q)) break;
            }

            if ($count == count($q)) {
                array_push($result, $profile);
            }
        }

        return $result;
    }
}
