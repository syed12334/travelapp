<?php

namespace App\Services\Admin;

use Illuminate\Support\Str;
use App\Repositories\Admin\PropertycategoryRepository;

class PropertycategoryService
{
    protected $pamenity;
    public function __construct(PropertycategoryRepository $am)
    {
        $this->pamenity = $am;
    }
    /* Fetch all service */
    public function getAmenity($request) {
        return $this->pamenity->getAllamenity($request);
    }
    /* Store amenity */
    public function store($req) {
        $req->validated();
         $d['pcamenity_uuid'] = Str::uuid();
        $d['pcamenity_text'] = $req['amenity'];
        $this->pamenity->store($d);
        return response()->json(['status'=>true,'msg'=>'Property category saved successfully']);
    }
    /* Edit list by id */
    public function edit($id) {
        return $this->pamenity->getAmenityById($id);
    }
     /* Update amenity by id*/
    public function update($request) {
        $amenity_id = $request['amenity_id'];
        $amenity = $request['amenity'];
        $data['pcamenity_text'] = $amenity;
        $this->pamenity->updateAmenityById($amenity_id,$data);
        return response()->json([
            'status' =>true,
            'msg'    =>'Property category updated successfully'
        ]);
    }
    /* Delete amenity by id */
    public function statusChange($request) {
        $amenity_id = $request['amenity_id'];
        $status = $request['status'];
        $msg = "";
        $data['status'] = $status;
        if($status ==0) {
            $msg = "Property category deactivated successfully";
        }
        else if($status ==1) {
             $msg = "Property category activated successfully";
        }
        else if($status ==2) {
             $msg = "Property category deleted successfully";
        }
        $this->pamenity->updateAmenityById($amenity_id,$data);
        return response()->json([
            'status' =>true,
            'msg'    =>$msg
        ]);
    } 
    /* Delete amenity by id */
    public function delete($id) {
        $this->pamenity->delete($id);
        return response()->json([
            'status' =>true,
            'msg'    =>'Property category deleted successfully'
        ]);
    } 
    /* Delete multiple amenities */
    public function deleteMultipleamenity($mdelete) {
        if(isset($mdelete['amenity_id']) && !empty($mdelete['amenity_id'])) {
            $data['status'] = 2;
            $this->pamenity->deleteMultipleAmenityById($mdelete['amenity_id'],$data);
            return back()->with('success','Property category deleted successfully');
        }
    } 
}
