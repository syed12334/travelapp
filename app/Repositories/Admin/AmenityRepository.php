<?php

namespace App\Repositories\Admin;

use App\Models\Amenity;

class AmenityRepository
{   
    protected $amenity;
    public function __construct(Amenity $amenity)
    {
        $this->amenity = $amenity;
    }
    /* Fetch all amenity */
    public function getAllAmenity($getRequest)
    {
        $query = $this->amenity->orderBy('id', 'desc');
        if(isset($getRequest['search']) && !empty($getRequest['search']) && strlen($getRequest['search']) >2) {
            $query->where('amenity_text','LIKE',"%{$getRequest['search']}%");
        } 
        $page = "";
        if(isset($getRequest['paging']) && !empty($getRequest['paging'])) {
            $page = $getRequest['paging'];
        } else {
            $page =10;
        } 
        if(isset($getRequest['status']) && !empty($getRequest['status']) && in_array($getRequest['status'],[4,1])) {
            if($getRequest['status'] ==4) {
                $query->where('status', 0);
            }else {
                $query->where('status', $getRequest['status']);
            }
        } else {
            $query->where('status', '!=', 2);
        }
        return $query->paginate($page);
    }

    /* Store amenity */
    public function store($data) {
        return $this->amenity->create($data);
    }
    /* Get amenity by id */
    public function getAmenityById($id) {
        return $this->amenity->where('id',$id)->first();
    }
      /* Update amenity by id */
    public function updateAmenityById($id,$data) {
        return $this->amenity->where('id',$id)->update($data);
    }
    /* Delete multiple by id */
    public function deleteMultipleAmenityById($amenity_id,$data) {
        if(isset($amenity_id) && is_array($amenity_id)) {
            return $this->amenity->whereIn('id',$amenity_id)->update($data);
        }
    }
}
