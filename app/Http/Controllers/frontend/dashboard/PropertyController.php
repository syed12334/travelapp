<?php

namespace App\Http\Controllers\frontend\dashboard;  
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StepsixValidate;
use App\Http\Requests\SteptwoValidate;
use App\Http\Requests\StepfiveValidate;
use App\Http\Requests\StepfourValidate;
use App\Http\Requests\StepsevenValidate;
use App\Http\Requests\StepthreeValidate;
use App\Services\frontend\dashboard\PropertyService;

class PropertyController extends Controller
{
    public $property;
    public function __construct(PropertyService $pro) {
        $this->property = $pro;
    }
    /*
        Function name : index
        Description : this function will show list of properties
    */
    public function index() {
        return view('frontend.dashboard.property.propertyadd',compact('states'));
    }
    /*
        Function name : steponeview
        Description : this function will property first form
    */
    public function steponeview() {
        $getPropertyLogs = $this->property->propertyLogs();
        if(!empty($getPropertyLogs) && isset($getPropertyLogs)) {
            $getPropertyDetails = json_decode($getPropertyLogs->property_details,true);
            $state = $getPropertyDetails['state'];
            $cities = $this->property->cities($state);
        }else {
            $cities =[];
        }
        $states = $this->property->states();   
        $property_category = $this->property->getPropertyCategories();
        return view('frontend.dashboard.property.steponeview',compact('property_category','states','cities'));
    }
    /*
        Function name : step1
        Description : this function will validate first form
    */
    public function step1(Request $request) {
       return $this->property->step_one($request->all());
    }
     /*
        Function name : steptwoview
        Description : this function will list second form
    */
    public function steptwoview() {
        return view('frontend.dashboard.property.steptwoview');
    }
    /*
        Function name : step2
        Description : this function will validate second form
    */
    public function step2(SteptwoValidate $request) {
       return $this->property->step_two($request);
    }
    /*
        Function name : stepthreeview
        Description : this function will list thirst form
    */
    public function stepthreeview() {
        return view('frontend.dashboard.property.stepthreeview');
    }
    /*
        Function name : step3
        Description : this function will validate third form
    */
    public function step3(StepthreeValidate $request)
    {
        return $this->property->step_three($request);
    }
    /*
        Function name : stepfourview
        Description : this function will list fourth form
    */
    public function stepfourview() {
        $property_amenity = $this->property->getPropertyAmenities();
        return view('frontend.dashboard.property.stepfourview',compact('property_amenity'));
    }
    /*
        Function name : step4
        Description : this function will validate fourth form
    */
    public function step4(StepfourValidate $request)
    {
        return $this->property->step_four($request);
    }
    /*
        Function name : stepfiveview
        Description : this function will list fifth form
    */
    public function stepfiveview() {
       $room_category = $this->property->getRoomCategory();
       $room_amenities = $this->property->getRoomAmenity();
       return view('frontend.dashboard.property.stepfiveview',compact('room_category','room_amenities'));
    }
    /*
        Function name : step5
        Description : this function will validate fifth form
    */
    public function step5(StepfiveValidate $request)
    {
        return $this->property->step_five($request);
    }
    /*
        Function name : stepsixview
        Description : this function will list sixth form
    */
    public function stepsixview() {
       return view('frontend.dashboard.property.stepsixview');
    }
    /*
        Function name : step6
        Description : this function will validate sixth form
    */
    public function step6(StepsixValidate $request)
    {
        return $this->property->step_six($request);
    }
    /*
        Function name : stepsevenview
        Description : this function will list seventh form
    */
    public function stepsevenview() {
       return view('frontend.dashboard.property.stepsevenview');
    }
    /*
        Function name : step3
        Description : this function will validate seventh form
    */
    public function step7(StepsevenValidate $request)
    {
        return $this->property->step_seven($request);
    }
    /*
        Function name : getAmenitiesAjax
        Description : this function will fetch all room amenity
    */
    public function getAmenitiesAjax(Request $req) {
        return $this->property->getAllRoomAmenityByAjax($req->all());
    }
    /* 
        Function name : getCity
        Description : This function all cities by state
    */
    public function getCity(Request $request) {
        $state = $request->state;
        $city =  $this->property->cities($state);
        $cityHtml = view('frontend.dashboard.property.getallcitybyajax',compact('city'))->render();
        return response()->json(['status'=>true,'city'=>$cityHtml]);
    } 
    /*
        Function name :thankyou
        description : this function will show thankyou page after property steps completed
    */
    public function thankyou() {
      $this->property->propertySave();
       return view('frontend.dashboard.property.thankyou');
    }
    /* 
        Function name :fetchProperty
        Description : this will fetch all property details
    */
    public function fetchProperty() {
       return  $this->property->fetchPropertyDetails();
    }
}

