<?php

namespace App\Http\Controllers\Backed;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pcamenities;
use App\Services\Admin\PropertycategoryService;

class PropertycategoryController extends Controller
{
    protected $pamenity;
    public function __construct(PropertycategoryService $pmser) {
        $this->pamenity = $pmser;
    }
    /* Amenity index */ 
    public function index(Request $request) {
        $amenity = $this->pamenity->getAmenity($request->all());
        if($request->ajax()) {
            return response()->json([
                'status' =>true,
                'html' => view('backed.property_category.pamenitydata', compact('amenity'))->render(),
            ]);
        }
        return view('backed.property_category.pamenities',compact('amenity'));
    }
    /* Store amenity */
    public function store(Pcamenities $req) {
       return $this->pamenity->store($req);
    }
    /* Edit list */
    public function edit(Request $request) {
        $id = $request->input('id');
        $amenity = $this->pamenity->edit($id);

        if ($amenity) {
            return response()->json([
                'status' => true,
                'msg'    => 'Property amenity data found.',
                'data'   => $amenity
            ]);
        }
        return response()->json([
            'status' => false,
            'msg'    => 'No property amenity data found.'
        ], 404);
    }
    /* Update amenity */
    public function update(Request $request) {
        $result = $this->pamenity->update($request->all());
       return $result;
    }
    /* status change amenity */
    public function statusChange(Request $re) {
        return $this->pamenity->statusChange($re->all());
    }
    /* Delete multiple amenities */
    public function multipleAmenityDelete(Request $request) {
        return $this->pamenity->deleteMultipleamenity($request->all());
    }
}
