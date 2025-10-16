<?php

namespace App\Services\frontend\dashboard;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Repositories\frontend\dashboard\PropertyRepository;

class PropertyService
{
    public $property;
    public function __construct(PropertyRepository $proRepo)
    {
        $this->property = $proRepo;
    }
    /* 
        Function :step_one
        Description : this function will validate and store data in session
    */
    public function step_one($request) {
       $validate =$this->validateProperty($request);
       if ($validate['status'] =="false") {
             $results = [
                'status'  => 422,
                'errors'  => $validate['errors'],
            ];
            return response()->json($results);
        }else {
            $session_id = session()->getId();
            $this->getPropertyLogsStoreOrUpdate($session_id,$request,1);
            session(['session_id'=>$session_id]);
            session(['step1'=>$request]);
            $response = ['status'=>true];
            return response()->json($response);
        }
    }
    /*
        Funtion name : propertyLogs
        Description :this function will fetch all property logs by userid and session id
    */
    public function propertyLogs() {
        $session_id = session('session_id');
        $user_id = auth()->id();
        return $this->property->propertyLogs($session_id,$user_id);
    }
    /* 
        Function name : getPropertyLogsUpdate
        Description : this function will store or update property logs based on session id and data and user id
    */
    public function getPropertyLogsStoreOrUpdate($session_id,$data,$current_page) {
        $user_id = auth()->id();
        $storesession = session('session_id');
        $json = json_encode($data);
        if(isset($storesession) && !empty($storesession)) {
            $getProLogs = $this->property->propertyLogs($storesession,$user_id);
        }else {
            $getProLogs = $this->property->propertyLogs($session_id,$user_id);
        }
        if(!empty($getProLogs)) {
            if($current_page ==1) {
                $jsonData['property_details'] = $json;
            }
            else if($current_page ==2) {
                $jsonData['current_page'] = $current_page;
                $jsonData['next_page'] = $current_page+1;
                $jsonData['property_personal_details'] = $json;
            }
            else if($current_page ==3) {
                $jsonData['current_page'] = $current_page;
                $jsonData['next_page'] = $current_page+1;
                $jsonData['property_photos_videos'] = $json;
            }
            else if($current_page ==4) {
                $jsonData['current_page'] = $current_page;
                $jsonData['next_page'] = $current_page+1;
                $jsonData['property_amenities'] = $json;
            }
            else if($current_page ==5) {
                $jsonData['current_page'] = $current_page;
                $jsonData['next_page'] = $current_page+1;
                $jsonData['property_room_categories'] = $json;
            }
            else if($current_page ==6) {
                $jsonData['current_page'] = $current_page;
                $jsonData['next_page'] = $current_page+1;
                $jsonData['property_house_rules'] = $json;
            }
            else if($current_page ==7) {
                $jsonData['current_page'] = $current_page;
                $jsonData['next_page'] = $current_page+1;
                $jsonData['property_near_by'] = $json;
            }
            $this->property->propertyLogsUpdate($storesession,$user_id,$jsonData);
        }else {
            $properLogs['user_id'] = $user_id;
            $properLogs['session_id'] = $session_id;
            $properLogs['current_page'] = $current_page;
            $properLogs['next_page'] = $current_page+1;
            $properLogs['property_details'] =$json;
            $this->property->propertyLogsStore($properLogs);
        }
    }
     /* Validate property input */
    public function validateProperty($userRequest) {
            $rules['email'] = ['required','email','regex:/(.+)@(.+)\.(.+)/i'];
            $rules['state'] = ['required'];
            $rules['city'] = ['required'];
            $rules['postal_address'] = ['required'];
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
            /* State & city */
            $messages['state.required'] = "Please select state";
            $messages['city.required'] = "Please select city";
            /* Postal address */
            $messages['postal_address.required'] = "Please enter postal address";
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
            $session_id = session('session_id');
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
            $this->getPropertyLogsStoreOrUpdate($session_id,$data,2);
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
            $session_id = session('session_id');
            $this->getPropertyLogsStoreOrUpdate($session_id,$photosSec,3);
            session(['step3'=>$photosSec]);
            $response = ['status'=>true];
            return response()->json($response);
        }
    }
    /* Property step 4 */
    public function step_four($request) {
        if($request->validated()) {
            $session_id = session('session_id');
            $this->getPropertyLogsStoreOrUpdate($session_id,$request->validated(),4);
            session(['step4'=>$request->validated()]);
            $response = ['status'=>true];
            return response()->json($response);
        }
    }
     /* Property step 5 */
    public function step_five($request) {
        if($request->validated()) {
            $uploadedFiles = [];
            if($request->hasFile('room_img')) {
                foreach ($request->file('room_img') as $file) {
                    $filename = time().'_'.$file->getClientOriginalName();
                    $file->move(public_path('room_img'), $filename);
                    $uploadedFiles[] = $filename;
                }
            }
            $rcategory['room_category'] = $request->room_category;
            $rcategory['room_image'] = $uploadedFiles;
            $rcategory['room_amenity'] = $request->room_amenity;
            $rcategory['no_of_rooms'] = $request->no_of_rooms;
            $rcategory['quad_room'] = $request->quad_room;
            $rcategory['price'] = $request->price;
            $rcategory['tax'] = $request->tax;
            $rcategory['discount'] = $request->discount;
            $rcategory['rate_inclusion'] = $request->rate_inclusion;
            $rcategory['room_category_no_of_am'] = $request->room_category_no_of_am;
            $session_id = session('session_id');
            $this->getPropertyLogsStoreOrUpdate($session_id,$rcategory,5);
            session(['step5'=>$rcategory]);
            $response = ['status'=>true];
            return response()->json($response);
        }
    }
       /* Property step 6 */
    public function step_six($request) {
        if($request->validated()) {
            $houserules = $request->validated();
            $session_id = session('session_id');
            $this->getPropertyLogsStoreOrUpdate($session_id,$houserules,6);
            session(['step6'=>$houserules]);
            $response = ['status'=>true];
            return response()->json($response);
        }
    }
     /* Property step 7 */
    public function step_seven($request) {
        if($request->validated()) {
            $nearby = $request->validated();
            $session_id = session('session_id');
            $this->getPropertyLogsStoreOrUpdate($session_id,$nearby,7);
            session(['step7'=>$nearby]);
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
    /*
      Function name : states
      Description : this function fetches all state
     */
    public function states() {
        return $this->property->states();
    }
    /*
      Function name : cities
      Description : this function fetches all cities by state
     */
    public function cities($state_id) {
        return $this->property->cities($state_id);
    }
    /*
        Function name : propertySave
        Description : this function will save property full details in to database
    */
    public function propertySave() {
        DB::beginTransaction();
        try {
            $getPropertyLogs = $this->propertyLogs();
            $session_id = session('session_id');
            if(isset($session_id) && !empty($session_id) && !empty($getPropertyLogs)) {
                $property_details = json_decode($getPropertyLogs->property_details,true);
                $property_personal_details = json_decode($getPropertyLogs->property_personal_details,true);
                $property_photos_videos = json_decode($getPropertyLogs->property_photos_videos,true);
                $property_amenities = json_decode($getPropertyLogs->property_amenities,true);
                $property_room_categories = json_decode($getPropertyLogs->property_room_categories,true);
                $property_house_rules = json_decode($getPropertyLogs->property_house_rules,true);
                $property_near_by = json_decode($getPropertyLogs->property_near_by,true);
                /* Insert property data */
                $propertyData = $this->propertyDetails($property_details);
                if($propertyData) {
                    /* Insert property personal details data */
                    $this->propertyPersonalDetails($propertyData,$property_personal_details);
                    /* Insert property youtube link data */
                    $this->propertyYoutubeDetails($propertyData,$property_photos_videos);
                    /* Insert property photos link data */
                    $this->propertyPhotosDetails($propertyData,$property_photos_videos);
                    /* Insert property amenity with count */
                    $this->propertyAmenityDetails($propertyData,$property_amenities);
                    /* Insert property house rules */
                    $this->propertyHouseRulesDetails($propertyData,$property_house_rules);
                    /* Insert property faq */
                    $this->propertyFaqDetails($propertyData,$property_near_by);
                    /* Insert property addon info */
                    $this->propertyAddonInfoDetails($propertyData,$property_near_by);
                    /* Insert property room category */
                    $this->propertyRoomCategoryDetails($propertyData,$property_room_categories);
                }
                session()->forget(['session_id']);
                DB::commit();
            }
        }
        catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    /* 
        Function name :propertyDetails
        Description : this function will store property details of property
    */
    public function propertyDetails($property_details) {
        $property['property_uuid'] = Str::uuid();
        $property['user_id'] = auth()->id();
        $property['property_type'] = $property_details['property_type'];
        $property['property_name'] = $property_details['property_name'];
        $property['booking_start_year'] = $property_details['booking_start_year'];
        $property['property_built_date'] = $property_details['property_built_date'];
        $property['property_hosted'] = $property_details['property_hosted'];
        $property['host_stay_property'] = $property_details['host_stay_property'];
        $property['state'] = $property_details['state'];
        $property['city'] = $property_details['city'];
        $property['email'] = $property_details['email'];
        $property['mobile_no'] = $property_details['mobile_no'];
        $property['whatsapp_no'] = $property_details['whatsapp_no'];
        $property['landline_no'] = $property_details['landline_no'];
        $property['postal_address'] = $property_details['postal_address'];
        $property['property_location'] = $property_details['property_location'];
        $propertyData = $this->property->store($property);
        return $propertyData;
    }
    /* 
        Function name :propertyPersonalDetails
        Description : this function will store personal details of property
    */
    public function propertyPersonalDetails($property,$newar) {
        $propertyPersonal['name_of_host'] =$newar['name_of_host']; 
        $propertyPersonal['email'] =$newar['personal_email']; 
        $propertyPersonal['mobile_no'] =$newar['personal_mobile_no']; 
        $propertyPersonal['profile_img'] =$newar['profile_img']; 
        $propertyPersonal['language_speak'] =$newar['language_speak']; 
        $propertyPersonal['hosting_since'] =$newar['hosting_since']; 
        $propertyPersonal['total_num_properties'] =$newar['total_num_properties']; 
        $propertyPersonal['personal_description'] =$newar['personal_description']; 
        $property->propertyDetails()->create($propertyPersonal);
    }
    /* 
        Function name :propertyYoutubeDetails
        Description : this function will store youtube details of property
    */
    public function propertyYoutubeDetails($property,$newar) {
          if(isset($newar['youtube_link']) && is_array($newar['youtube_link']) && !empty($newar['youtube_link'])) {
            foreach($newar['youtube_link'] as $k => $val) {
                $propertyYoutube['youtube_link'] = $val;
                $property->propertyYoutubeLink()->create($propertyYoutube);
            }
          }
    }
    /* 
        Function name :propertyPhotosDetails
        Description : this function will store youtube details of property
    */
    public function propertyPhotosDetails($property,$newar) {
          if(isset($newar['photos']) && is_array($newar['photos']) && !empty($newar['photos'])) {
              foreach($newar['photos'] as $ks => $vals) {
                  $propertyPhotos['photo_path'] = $vals;
                  $property->propertyPhotos()->create($propertyPhotos);
              }
          }
    }
    /* 
        Function name :propertyAmenityDetails
        Description : this function will store amenity details of property
    */
    public function propertyAmenityDetails($property,$newar) {
          $step4 = session('step4');
          if(isset($newar['property_amenity']) && is_array($newar['property_amenity']) && !empty($newar['property_amenity'])) {
              foreach($newar['property_amenity'] as $j => $ls) {
                  $propertyAmenList['property_amenity_id'] = $ls;
                  $propertyAmenList['property_no_of_amenity'] = $step4['no_of_am'][$j];
                  $property->propertyAmenityList()->create($propertyAmenList);
              }
          }
    }
    /* 
        Function name :propertyHouseRulesDetails
        Description : this function will store house rules details of property
    */
    public function propertyHouseRulesDetails($property,$newar) {
           if(isset($newar['check_in']) && !empty($newar['check_in'])
                && isset($newar['check_out']) && !empty($newar['check_out'])
                && isset($newar['cancel_prepay']) && !empty($newar['cancel_prepay'])
                && isset($newar['children_beds']) && !empty($newar['children_beds'])
                && isset($newar['no_age_restrict']) && !empty($newar['no_age_restrict'])
                && isset($newar['pets']) && !empty($newar['pets'])
                && isset($newar['groups']) && !empty($newar['groups'])
                && isset($newar['accept_payment_method']) && !empty($newar['accept_payment_method'])
                && isset($newar['parties']) && !empty($newar['parties'])
                ) 
            {
                $houseRules['check_in'] = $newar['check_in'];
                $houseRules['check_out'] = $newar['check_out'];
                $houseRules['cancel_prepay'] = $newar['cancel_prepay'];
                $houseRules['children_beds'] = $newar['children_beds'];
                $houseRules['no_age_restrict'] = $newar['no_age_restrict'];
                $houseRules['pets'] = $newar['pets'];
                $houseRules['groups'] = $newar['groups'];
                $houseRules['parties'] = $newar['parties'];
                $houseRules['accept_payment_method'] = $newar['accept_payment_method'];
                $property->propertyHouseRules()->create($houseRules);
            }
    }
    /* 
        Function name :propertyFaqDetails
        Description : this function will store faq details of property
    */
    public function propertyFaqDetails($property,$newar) {
       if(isset($newar['question']) 
            && is_array($newar['question']) 
            && !empty($newar['question'])) {
            foreach($newar['question'] as $ks => $que) {
                $faq['question'] = $que;
                $faq['answer'] = $newar['question'][$ks];
                $property->propertyFaq()->create($faq);
            }
        }
    }
    /*
        Function name :propertyAddonInfoDetails
        Description : this function will store addon info details of property
    */
    public function propertyAddonInfoDetails($propertyData,$newar) {
        if(isset($newar['restaurant_info']) && !empty($newar['restaurant_info']) 
            && isset($newar['near_by_location'])  && !empty($newar['near_by_location'])) {
            $propertyAddonInfo['restaurant_info'] = $newar['restaurant_info'];
            $propertyAddonInfo['near_by_location'] = $newar['near_by_location'];
            $propertyData->propertyAddonInfo()->create($propertyAddonInfo);
        }
    }
    /*
        Function name :propertyRoomCategoryDetails
        Description : this function will store room category details of property
    */
    public function propertyRoomCategoryDetails($propertyData,$newar) {
        if(is_array($newar['room_category']) && isset($newar['room_category']) && !empty($newar['room_category']) 
            && is_array($newar['room_image']) && isset($newar['room_image'])  && !empty($newar['room_image'])
            && is_array($newar['no_of_rooms']) && isset($newar['no_of_rooms'])  && !empty($newar['no_of_rooms'])
            && is_array($newar['quad_room']) && isset($newar['quad_room'])  && !empty($newar['quad_room'])
            && is_array($newar['price']) && isset($newar['price'])  && !empty($newar['price'])
            && is_array($newar['tax']) && isset($newar['tax'])  && !empty($newar['tax'])
            && is_array($newar['discount']) && isset($newar['discount'])  && !empty($newar['discount'])
            && is_array($newar['rate_inclusion']) && isset($newar['rate_inclusion'])  && !empty($newar['rate_inclusion'])
            ) {
            foreach($newar['room_category'] as $rk => $rcate) {
                $propertyRoomCate['room_category_id'] = $rcate;
                $propertyRoomCate['occupancy'] = $newar['quad_room'][$rk];
                $propertyRoomCate['no_of_rooms'] = $newar['no_of_rooms'][$rk];
                $propertyRoomCate['price'] = $newar['price'][$rk];
                $propertyRoomCate['tax'] = $newar['tax'][$rk];
                $propertyRoomCate['discount'] = $newar['discount'][$rk];
                $propertyRoomCate['room_image'] = $newar['room_image'][$rk];
                $propertyRoomCate['rate_inclusion'] = $newar['rate_inclusion'][$rk];
                $propertyRcateId = $propertyData->propertyRoomCategoryList()->create($propertyRoomCate);
                if($propertyRcateId) {
                    if(isset($newar['room_amenity'][$rk]) 
                        && !empty($newar['room_amenity'][$rk])) {
                        foreach($newar['room_amenity'][$rk] as $rak => $rat) {
                            $propertyRomCatAmen['amenity_id'] = $rat;
                            $propertyRcateId->propertyRoomCateAmenity()->create($propertyRomCatAmen);
                        }
                    }
                }
            }
        }
    }
    /*
        Function name : fetchPropertyDetails
        Description : this function will fetch all property details
    */
    public function fetchPropertyDetails() {
        $user_id = auth()->id();
        return $this->property->fetchAllPropertyDetails($user_id);
    }
}
