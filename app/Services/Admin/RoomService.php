<?php

namespace App\Services\Admin;

use App\Repositories\Admin\RoomRepository;
use Illuminate\Support\Str;
class RoomService
{
     protected $rooms;
    public function __construct(RoomRepository $room)
    {
        $this->rooms = $room;
    }
    /* Fetch all service */
    public function getRooms($request) {
        return $this->rooms->getAllRooms($request);
    }
    /* Store amenity */
    public function store($req) {
        $req->validated();
         $d['room_uuid'] = Str::uuid();
        $d['rooms'] = $req['room'];
        $this->rooms->store($d);
        return response()->json(['status'=>true,'msg'=>'Room category saved successfully']);
    }
    /* Edit list by id */
    public function edit($id) {
        return $this->rooms->getRoomById($id);
    }
     /* Update amenity by id*/
    public function update($request) {
        $room_id = $request['room_id'];
        $room = $request['room'];
        $data['rooms'] = $room;
        $this->rooms->updateRoomById($room_id,$data);
        return response()->json([
            'status' =>true,
            'msg'    =>'Room category updated successfully'
        ]);
    }
    /* Delete amenity by id */
    public function statusChange($request) {
        $amenity_id = $request['amenity_id'];
        $status = $request['status'];
        $msg = "";
        $data['status'] = $status;
        if($status ==0) {
            $msg = "Room category deactivated successfully";
        }
        else if($status ==1) {
             $msg = "Room category activated successfully";
        }
        else if($status ==2) {
             $msg = "Room category deleted successfully";
        }
        $this->rooms->updateRoomById($amenity_id,$data);
        return response()->json([
            'status' =>true,
            'msg'    =>$msg
        ]);
    } 
    /* Delete amenity by id */
    public function delete($id) {
        $this->rooms->delete($id);
        return response()->json([
            'status' =>true,
            'msg'    =>'Room category deleted successfully'
        ]);
    } 
    /* Delete multiple amenities */
    public function deleteMultipleroom($mdelete) {
        if(isset($mdelete['room_id']) && !empty($mdelete['room_id'])) {
            $data['status'] = 2;
            $this->rooms->deleteMultipleRoomById($mdelete['room_id'],$data);
            return back()->with('success','Room category deleted successfully');
        }
    } 
}
