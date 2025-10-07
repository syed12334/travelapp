<?php

namespace App\Repositories\Admin;
use App\Models\Room_category;

class RoomRepository
{
   protected $rooms;
    public function __construct(Room_category $room)
    {
        $this->rooms = $room;
    }
    /* Fetch all rooms */
    public function getAllRooms($getRequest)
    {
        $query = $this->rooms->orderBy('id', 'desc');
        if(isset($getRequest['search']) && !empty($getRequest['search']) && strlen($getRequest['search']) >2) {
            $query->where('rooms','LIKE',"%{$getRequest['search']}%");
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

    /* Store room category */
    public function store($data) {
        return $this->rooms->create($data);
    }
    /* Get room category by id */
    public function getRoomById($id) {
        return $this->rooms->where('id',$id)->first();
    }
      /* Update room catgory by id */
    public function updateRoomById($id,$data) {
        return $this->rooms->where('id',$id)->update($data);
    }
    /* Delete multiple room category by id */
    public function deleteMultipleRoomById($room_id,$data) {
        if(isset($room_id) && is_array($room_id)) {
            return $this->rooms->whereIn('id',$room_id)->update($data);
        }
    }
}
