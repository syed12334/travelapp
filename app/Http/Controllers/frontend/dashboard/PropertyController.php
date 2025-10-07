<?php

namespace App\Http\Controllers\frontend\dashboard;  
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SteptwoValidate;
use App\Http\Requests\StepfiveValidate;
use App\Http\Requests\StepfourValidate;
use App\Http\Requests\StepthreeValidate;
use App\Services\frontend\dashboard\PropertyService;

class PropertyController extends Controller
{
    public $property;
    public function __construct(PropertyService $pro) {
        $this->property = $pro;
    }
    public function index() {
        return view('frontend.dashboard.property.propertyadd');
    }
    /* Property step1 view */
    public function steponeview() {
        $property_category = $this->property->getPropertyCategories();
        return view('frontend.dashboard.property.steponeview',compact('property_category'));
    }
    /* Property step1 validation */
    public function step1(Request $request) {
       return $this->property->step_one($request->all());
    }
     /* Property step2 view */
    public function steptwoview() {
        return view('frontend.dashboard.property.steptwoview');
    }
     /* Property step2 validation */
    public function step2(SteptwoValidate $request) {
       return $this->property->step_two($request);
    }
     /* Property step3 view */
    public function stepthreeview() {
        return view('frontend.dashboard.property.stepthreeview');
    }
    /* Property Step3 validation */
    public function step3(StepthreeValidate $request)
    {
        return $this->property->step_three($request);
    }
      /* Property step4 view */
    public function stepfourview() {
        // echo "<pre>";print_r(session('step4'));exit;
        $property_amenity = $this->property->getPropertyAmenities();
        return view('frontend.dashboard.property.stepfourview',compact('property_amenity'));
    }
    /* Property Step4 validation */
    public function step4(StepfourValidate $request)
    {
        return $this->property->step_four($request);
    }
    /* Property step5 view */
    public function stepfiveview() {
        // echo "<pre>";print_r(session('step5'));exit;
       $room_category = $this->property->getRoomCategory();
       $room_amenities = $this->property->getRoomAmenity();
       return view('frontend.dashboard.property.stepfiveview',compact('room_category','room_amenities'));
    }
    /* Property Step5 validation */
    public function step5(StepfiveValidate $request)
    {
        return $this->property->step_five($request);
    }
    /* Property step6 view */
    public function stepsixview() {
       $room_category = $this->property->getRoomCategory();
       $room_amenities = $this->property->getRoomAmenity();
       return view('frontend.dashboard.property.stepfiveview',compact('room_category','room_amenities'));
    }
    /* Property Step5 validation */
    public function step6(StepsixValidate $request)
    {
        return $this->property->step_six($request);
    }
    /* Get all amenities by ajax */
    public function getAmenitiesAjax(Request $req) {
        return $this->property->getAllRoomAmenityByAjax($req->all());
    }
}

