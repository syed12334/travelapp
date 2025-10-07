<?php

namespace App\Http\Controllers\Backed;

use Illuminate\Http\Request;
use App\Services\Admin\CityService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;

class CityController extends Controller
{
    public $cities;
    public function __construct(CityService $city) {
        $this->cities = $city;
    }
    /* Store index */ 
    public function index(Request $request) {
        $cities = $this->cities->getCities($request->all());
        $states = $this->cities->getStates();
        if($request->ajax()) {
            return response()->json([
                'status' =>true,
                'html' => view('backed.cities.citydata', compact('cities','states'))->render(),
            ]);
        }
        return view('backed.cities.city',compact('cities','states'));
    }
    /* Store state */
    public function store(CityRequest $req) {
       return $this->cities->store($req);
    }
    /* Edit state */
    public function edit(Request $request) {
        $id = $request->input('id');
        $states = $this->cities->edit($id);
        if ($states) {
            return response()->json([
                'status' => true,
                'msg'    => 'City data found.',
                'data'   => $states
            ]);
        }
        return response()->json([
            'status' => false,
            'msg'    => 'No city data found.'
        ], 404);
    }
    /* Update state */
    public function update(Request $request) {
       $result = $this->cities->update($request->all());
       return $result;
    }
    /* status change state */
    public function statusChange(Request $re) {
        return $this->cities->statusChange($re->all());
    }
    /* Delete multiple states */
    public function multipleCityDelete(Request $request) {
        return $this->cities->deleteMultiplecity($request->all());
    }
}
