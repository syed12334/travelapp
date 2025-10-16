<?php

namespace App\Repositories\frontend\dashboard;
use App\Models\State;
use App\Models\Amenity;
use App\Models\Pamenity;
use App\Models\Property;
use App\Models\Admin\City;
use App\Models\Room_category;
use App\Models\Property_category;
use App\Models\Property_log;

class PropertyRepository
{
    protected $property;
    protected $property_category;
    protected $property_amenity;
    protected $room_category;
    protected $room_amenity;
    protected $states;
    protected $cities;
    protected $property_log;
    public function __construct(Amenity $ameni, Property $pro,Property_category $pcate,Pamenity $pame,Room_category $rcat,State $state,City $city,Property_log $property_log)
    {
        $this->property = $pro;
        $this->property_category = $pcate;
        $this->property_amenity = $pame;
        $this->room_category = $rcat;
        $this->room_amenity = $ameni;
        $this->states = $state;
        $this->cities = $city;
        $this->property_log = $property_log;
    }
    /* Store property list */
    public function store($property) {
        return $this->property->create($property);
    }
    /* Get all property categories */
    public function getAllPcategories(){
        return $this->property_category->orderBy('id','desc')->get();
    }
     /* Get all property amenities */
    public function getAllProAmenities(){
        return $this->property_amenity->orderBy('id','desc')->get();
    }
    /* Get room category */
    public function getAllRoomCate() {
        return $this->room_category->orderBy('id','desc')->get();
    }
    /* Get room amenities */
    public function getAllRoomAmenity() {
        return $this->room_amenity->orderBy('id','desc')->get();
    }
    /*
        Function name: states
        Description : This function will fetch all states
    */
    public function states() {
        return $this->states->select(['id','name'])->active()->orderBy('name','asc')->get();
    }
     /*
        Function name: cities
        Description : This function will get all cities with state
    */
    public function cities($state_id) {
        return $this->cities->select(['id','state_id','city_name'])->active()->where(['state_id'=>$state_id])->orderBy('city_name','asc')->get();
    }
    /*
        Function name : propertyLogs
        Description : this function will fetch all property logs
    */
    public function propertyLogs($session_id,$user_id) {
        return $this->property_log->where(['session_id'=>$session_id,'user_id'=>$user_id])->first();
    }
    /*
        Function name : propertyLogsStore
        Description : this function will store property step details as a logs
    */
    public function propertyLogsStore($data) {
        return $this->property_log->create($data);
    }
     /*
        Function name : propertyLogsUpdate
        Description : this function will update property step
    */
    public function propertyLogsUpdate($session_id,$user_id,$data) {
        return $this->property_log->where(['session_id'=>$session_id,'user_id'=>$user_id])->update($data);
    }
     /* Store property category amenity */
    public function storePropCateAmenity($data) {
        return $this->property->storePropCateAmenity($data);
    }
    /* Fetch all property details */
    public function fetchAllPropertyDetails($user_id) {
        return $this->property->fetchAllPropertyDetails($user_id);
    }
}
