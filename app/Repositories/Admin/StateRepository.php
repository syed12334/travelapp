<?php
namespace App\Repositories\Admin;
use App\Models\State;
class StateRepository
{
   protected $states;
    public function __construct(State $state)
    {
        $this->states = $state;
    }
    /* Fetch all states */
    public function getAllStates($getRequest)
    {
        $query = $this->states->orderBy('id', 'desc');
        if(isset($getRequest['search']) && !empty($getRequest['search']) && strlen($getRequest['search']) >2) {
            $query->where('name','LIKE',"%{$getRequest['search']}%");
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
    /* Store state */
    public function store($data) {
        return $this->states->create($data);
    }
    /* Get state by id */
    public function getStateById($id) {
        return $this->states->where('id',$id)->first();
    }
      /* Update state by id */
    public function updateStateById($id,$data) {
        return $this->states->where('id',$id)->update($data);
    }
    /* Delete multiple state by id */
    public function deleteMultipleStateById($state_id,$data) {
        if(isset($state_id) && is_array($state_id)) {
            return $this->states->whereIn('id',$state_id)->update($data);
        }
    }
}
