<?php

namespace App\Http\Controllers\Backed;

use Illuminate\Http\Request;
use App\Services\Admin\RoomService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomRequest;

class RoomController extends Controller
{
    protected $rooms;
    public function __construct(RoomService $room) {
        $this->rooms = $room;
    }
    /* Room category index */ 
    public function index(Request $request) {
        $rooms = $this->rooms->getRooms($request->all());
        if($request->ajax()) {
            return response()->json([
                'status' =>true,
                'html' => view('backed.room.roomsdata', compact('rooms'))->render(),
            ]);
        }
        return view('backed.room.rooms',compact('rooms'));
    }
    /* Store room category */
    public function store(RoomRequest $req) {
       return $this->rooms->store($req);
    }
    /* Edit list */
    public function edit(Request $request) {
        $id = $request->input('id');
        $amenity = $this->rooms->edit($id);
        if ($amenity) {
            return response()->json([
                'status' => true,
                'msg'    => 'Room category data found.',
                'data'   => $amenity
            ]);
        }
        return response()->json([
            'status' => false,
            'msg'    => 'No room category data found.'
        ], 404);
    }
    /* Update room category */
    public function update(Request $request) {
        $result = $this->rooms->update($request->all());
       return $result;
    }
    /* status change room category */
    public function statusChange(Request $re) {
        return $this->rooms->statusChange($re->all());
    }
    /* Delete multiple room category */
    public function multipleRoomDelete(Request $request) {
        return $this->rooms->deleteMultipleroom($request->all());
    }
}
