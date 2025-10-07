<?php

namespace App\Services\frontend\dashboard;
use Illuminate\Support\Facades\Validator;
use App\Repositories\frontend\dashboard\PropertyRepository;
class PropertyService
{
    public $property;
    public function __construct(PropertyRepository $proRepo)
    {
        $this->property = $proRepo;
    }
    /* Property step 1 */
    public function step_one($request) {
       $validate =$this->validateProperty($request);
       if ($validate['status'] =="false") {
             $results = [
                'status'  => 422,
                'errors'  => $validate['errors'],
            ];
            return response()->json($results);
        }else {
            session(['step1'=>$request]);
            $response = ['status'=>true];
            return response()->json($response);
        }
    }
     /* Validate property input */
    public function validateProperty($userRequest) {
            $rules['email'] = ['required','email','regex:/(.+)@(.+)\.(.+)/i'];
            $rules['property_name'] =["required","string","max:70"];
            $rules['booking_start_year'] =["required"];
            $rules['property_built_date'] =["required"];
            $rules['property_location'] =["required","url"];
            $rules['property_hosted'] =["required"];
            $rules['host_stay_property'] =["required"];
            $rules['mobile_no'] =["required","integer","min:10"];
            $rules['whatsapp_no'] =["nullable","integer","min:10"];
            $rules['landline_no'] =["nullable", "integer","min:8"];
            /* Custom messages */
            $messages['email.required'] = "Please enter email id";
            $messages['email.regex'] = "Please enter valid emailid";
            $messages['booking_start_year.required'] = "Booking start date is required";
            $messages['property_built_date.required'] = "Property built date is required";
            $messages['property_hosted.required'] = "Host stay property is required";
            $messages['host_stay_property.required'] = "Property name is required";
            $messages['property_location.required'] = "Property location is required";
            $messages['property_location.url'] = "Property location should be valid url";
            /* Mobile No */
            $messages['mobile_no.required'] = "Mobile no is required";
            $messages['mobile_no.max'] = "Mobile no maximum no 12";
            $messages['mobile_no.integer'] = "Mobile no is should be integer";
               /* Landline No */
            $messages['landline_no.required'] = "Landline no is required";
            $messages['landline_no.max'] = "Landline no maximum no 8";
            $messages['landline_no.integer'] = "Landline no is should be integer";
            /* Whatsapp No */
            $messages['whatsapp_no.max'] = "Whatsapp no should be max 12";
            $messages['whatsapp_no.required'] = "Whatsapp no is required";
            $messages['whatsapp_no.integer'] = "Whatsapp no is should be integer";
            $validator = Validator::make($userRequest, $rules,$messages);
            if ($validator->fails()) {
                $result = [
                    'status'  => "false",
                    'errors'  => $validator->errors(),
                ];
                return $result;
            }  
            else {
                $result = [
                    'status'  => "true",
                ];
                return $result;
            }
    }
    /* Property step 2 */
    public function step_two($request) {
        if($request->validated()) {
            $path ="";
            if($request->hasFile('profile_img')) {
                 $file = $request->file('profile_img');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('user_profile'), $filename);
                $path = $filename;
            }
            $data['name_of_host'] =$request->name_of_host;
            $data['personal_email'] =$request->personal_email;
            $data['personal_mobile_no'] =$request->personal_mobile_no;
            $data['personal_whatsapp_no'] =$request->personal_whatsapp_no;
            $data['language_speak'] =$request->language_speak;
            $data['hosting_since'] =$request->hosting_since;
            $data['total_num_properties'] =$request->total_num_properties;
            $data['personal_description'] =$request->personal_description;
            $data['profile_img'] =$path;
            session(['step2'=>$data]);
            $response = ['status'=>true];
            return response()->json($response);
        } 
    }
    /* Property step 3 */
    public function step_three($request) {
        if($request->validated()) {
            $uploadedFiles = [];
            if($request->hasFile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $filename = time().'_'.$file->getClientOriginalName();
                    $file->move(public_path('gallery'), $filename);
                    $uploadedFiles[] = $filename;
                }
            }
            $photosSec['youtube_link'] = $request->youtube_link;
            $photosSec['photos'] = $uploadedFiles;
            session(['step3'=>$photosSec]);
            $response = ['status'=>true];
            return response()->json($response);
        }
    }
    /* Property step 4 */
    public function step_four($request) {
        if($request->validated()) {
            $amenities['property_amenity'] = $request->property_amenity;
            $amenities['no_of_am'] = $request->no_of_am;
            session(['step4'=>$amenities]);
            $response = ['status'=>true];
            return response()->json($response);
        }
    }
     /* Property step 5 */
    public function step_five($request) {
        if($request->validated()) {
            $rcategory['room_category'] = $request->room_category;
            $rcategory['no_of_am'] = $request->no_of_am;
            $rcategory['room_amenity'] = $request->room_amenity;
            session(['step5'=>$rcategory]);
            $response = ['status'=>true];
            return response()->json($response);
        }
    }
     /* Get all property categories */
    public function getPropertyCategories() {
        return $this->property->getAllPcategories();
    }
      /* Get all property amenities */
    public function getPropertyAmenities() {
        return $this->property->getAllProAmenities();
    }
      /* Get all room categories */
    public function getRoomCategory() {
        return $this->property->getAllRoomCate();
    }
    /* Get all room amenities */
    public function getRoomAmenity() {
        return $this->property->getAllRoomAmenity();
    }
    /* Get all room amenities by ajax */
    public function getAllRoomAmenityByAjax($request) {
        $index = $request['index'];
        $room_amenities = $this->getRoomAmenity();
        $html = view('frontend.dashboard.property.getamenitybyajax',compact('room_amenities','index'))->render();
        return response()->json(['status'=>true,'html'=>$html]);
    }
}
