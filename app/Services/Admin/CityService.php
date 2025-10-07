<?php

namespace App\Services\Admin;

use Illuminate\Support\Str;
use App\Repositories\Admin\CityRepository;

class CityService
{
    protected $cities;
    public function __construct(CityRepository $city)
    {
        $this->cities = $city;
    }
    /* Fetch all cities */
    public function getCities($request) {
        return $this->cities->getAllCities($request);
    }
    /* Store state */
    public function store($req) {
        $req->validated();
        $d['state_id'] = $req['state'];
        $d['city_uuid'] = Str::uuid();
        $d['city_name'] = $req['name'];
        $this->cities->store($d);
        return response()->json(['status'=>true,'msg'=>__('messages.city_store')]);
    }
    /* Edit list by id */
    public function edit($id) {
        return $this->cities->getCityById($id);
    }
     /* Update amenity by id*/
    public function update($request) {
        $city_id = $request['city_id'];
        $name = $request['name'];
        $data['state_id'] = $request['state'];
        $data['city_name'] = $name;
        $this->cities->updateCityById($city_id,$data);
        return response()->json([
            'status' =>true,
            'msg'    =>__('messages.city_update')
        ]);
    }
    /* Delete amenity by id */
    public function statusChange($request) {
        $city_id = $request['city_id'];
        $status = $request['status'];
        $msg = "";
        $data['status'] = $status;
        if($status ==0) {
            $msg = __('messages.city_deactivated');
        }
        else if($status ==1) {
             $msg = __('messages.city_activate');
        }
        else if($status ==2) {
             $msg = __('messages.city_delete');
        }
        $this->cities->updateCityById($city_id,$data);
        return response()->json([
            'status' =>true,
            'msg'    =>$msg
        ]);
    } 
    /* Delete amenity by id */
    public function delete($id) {
        $this->cities->delete($id);
        return response()->json([
            'status' =>true,
            'msg'    =>__('messages.city_delete')
        ]);
    } 
    /* Delete multiple cities */
    public function deleteMultiplecity($mdelete) {
        if(isset($mdelete['city_id']) && !empty($mdelete['city_id'])) {
            $data['status'] = 2;
            $this->cities->deleteMultipleCityById($mdelete['city_id'],$data);
            return back()->with('success',__('messages.city_multiple_delete'));
        }
    } 
    /* Get states */
    public function getStates() {
        return $this->cities->getStates();
    }
}
