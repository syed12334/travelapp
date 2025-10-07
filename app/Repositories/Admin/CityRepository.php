<?php
namespace App\Repositories\Admin;
use App\Models\State;
use App\Models\Admin\City;

class CityRepository
{
   protected $cities;
   protected $states;
    public function __construct(City $city,State $state)
    {
        $this->cities = $city;
        $this->states = $state;
    }
    /* Fetch all cities */
    public function getAllCities($getRequest)
    {
        $query = $this->cities->with('state:id,name')->orderBy('id', 'desc');
        if(isset($getRequest['search']) && !empty($getRequest['search']) && strlen($getRequest['search']) >2) {
            $query->where('city_name','LIKE',"%{$getRequest['search']}%");
        }

        if(isset($getRequest['state']) && !empty($getRequest['state'])) {
            if($getRequest['state'] !=-1) {
                $query->where('state_id',$getRequest['state']);
            }
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
    /* Store city */
    public function store($data) {
        return $this->cities->create($data);
    }
    /* Get city by id */
    public function getCityById($id) {
        return $this->cities->where('id',$id)->first();
    }
      /* Update city by id */
    public function updateCityById($id,$data) {
        return $this->cities->where('id',$id)->update($data);
    }
    /* Delete multiple city by id */
    public function deleteMultipleCityById($city_id,$data) {
        if(isset($city_id) && is_array($city_id)) {
            return $this->cities->whereIn('id',$city_id)->update($data);
        }
    }
    /* Get states */
    public function getStates() {
        return $this->states->where('status',1)->orderBy('id','desc')->get();
    }
}
