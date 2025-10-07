<?php

namespace App\Http\Controllers\Backed;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\StateService;
use App\Http\Requests\Admin\StateRequest;

class StateController extends Controller
{
    public $states;
    public function __construct(StateService $state) {
        $this->states = $state;
    }
    /* Store index */ 
    public function index(Request $request) {
        $states = $this->states->getStates($request->all());
        if($request->ajax()) {
            return response()->json([
                'status' =>true,
                'html' => view('backed.states.statedata', compact('states'))->render(),
            ]);
        }
        return view('backed.states.state',compact('states'));
    }
    /* Store state */
    public function store(StateRequest $req) {
       return $this->states->store($req);
    }
    /* Edit state */
    public function edit(Request $request) {
        $id = $request->input('id');
        $states = $this->states->edit($id);
        if ($states) {
            return response()->json([
                'status' => true,
                'msg'    => 'State data found.',
                'data'   => $states
            ]);
        }
        return response()->json([
            'status' => false,
            'msg'    => 'No state data found.'
        ], 404);
    }
    /* Update state */
    public function update(Request $request) {
       $result = $this->states->update($request->all());
       return $result;
    }
    /* status change state */
    public function statusChange(Request $re) {
        return $this->states->statusChange($re->all());
    }
    /* Delete multiple states */
    public function multipleStateDelete(Request $request) {
        return $this->states->deleteMultiplestate($request->all());
    }
}
