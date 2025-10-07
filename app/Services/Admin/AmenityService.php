<?php

namespace App\Services\Admin;

use Illuminate\Support\Str;
use App\Repositories\Admin\AmenityRepository;

class AmenityService
{
    protected $amenity;
    public function __construct(AmenityRepository $am)
    {
        $this->amenity = $am;
    }
    /* Fetch all service */
    public function getAmenity($request) {
        return $this->amenity->getAllamenity($request);
    }
    /* Store amenity */
    public function store($req) {
        $req->validated();
        $d['amenity_uuid'] = Str::uuid();
        $d['amenity_text'] = $req['amenity'];
        $this->amenity->store($d);
        return response()->json(['status'=>true,'msg'=>'Amenity saved successfully']);
    }
    /* Edit list by id */
    public function edit($id) {
        return $this->amenity->getAmenityById($id);
    }
     /* Update amenity by id*/
    public function update($request) {
        $amenity_id = $request['amenity_id'];
        $amenity = $request['amenity'];
        $data['amenity_text'] = $amenity;
        $this->amenity->updateAmenityById($amenity_id,$data);
        return response()->json([
            'status' =>true,
            'msg'    =>'Amenity updated successfully'
        ]);
    }
    /* Delete amenity by id */
    public function statusChange($request) {
        $amenity_id = $request['amenity_id'];
        $status = $request['status'];
        $msg = "";
        $data['status'] = $status;
        if($status ==0) {
            $msg = "Amenity deactivated successfully";
        }
        else if($status ==1) {
             $msg = "Amenity activated successfully";
        }
        else if($status ==2) {
             $msg = "Amenity deleted successfully";
        }
        $this->amenity->updateAmenityById($amenity_id,$data);
        return response()->json([
            'status' =>true,
            'msg'    =>$msg
        ]);
    } 
    /* Delete amenity by id */
    public function delete($id) {
        $this->amenity->delete($id);
        return response()->json([
            'status' =>true,
            'msg'    =>'Amenity deleted successfully'
        ]);
    } 
    /* Delete multiple amenities */
    public function deleteMultipleamenity($mdelete) {
        if(isset($mdelete['amenity_id']) && !empty($mdelete['amenity_id'])) {
            $data['status'] = 2;
            return $this->amenity->deleteMultipleAmenityById($mdelete['amenity_id'],$data);
        }
    } 
}
