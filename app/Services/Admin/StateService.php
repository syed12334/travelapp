<?php

namespace App\Services\Admin;

use Illuminate\Support\Str;
use App\Repositories\Admin\StateRepository;

class StateService
{
    protected $states;
    public function __construct(StateRepository $state)
    {
        $this->states = $state;
    }
    /* Fetch all service */
    public function getStates($request) {
        return $this->states->getAllStates($request);
    }
    /* Store state */
    public function store($req) {
        $req->validated();
        $d['state_uuid'] = Str::uuid();
        $d['name'] = $req['name'];
        $this->states->store($d);
        return response()->json(['status'=>true,'msg'=>__('messages.state_store')]);
    }
    /* Edit list by id */
    public function edit($id) {
        return $this->states->getStateById($id);
    }
     /* Update amenity by id*/
    public function update($request) {
        $state_id = $request['state_id'];
        $name = $request['name'];
        $data['name'] = $name;
        $this->states->updateStateById($state_id,$data);
        return response()->json([
            'status' =>true,
            'msg'    =>__('messages.state_update')
        ]);
    }
    /* Delete amenity by id */
    public function statusChange($request) {
        $state_id = $request['state_id'];
        $status = $request['status'];
        $msg = "";
        $data['status'] = $status;
        if($status ==0) {
            $msg = __('messages.state_deactivated');
        }
        else if($status ==1) {
             $msg = __('messages.state_activate');
        }
        else if($status ==2) {
             $msg = __('messages.state_delete');
        }
        $this->states->updateStateById($state_id,$data);
        return response()->json([
            'status' =>true,
            'msg'    =>$msg
        ]);
    } 
    /* Delete amenity by id */
    public function delete($id) {
        $this->states->delete($id);
        return response()->json([
            'status' =>true,
            'msg'    =>__('messages.state_delete')
        ]);
    } 
    /* Delete multiple states */
    public function deleteMultiplestate($mdelete) {
        if(isset($mdelete['state_id']) && !empty($mdelete['state_id'])) {
            $data['status'] = 2;
            $this->states->deleteMultipleStateById($mdelete['state_id'],$data);
            return back()->with('success',__('messages.state_multiple_delete'));
        }
    } 
}
