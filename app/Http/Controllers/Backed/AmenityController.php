<?php

namespace App\Http\Controllers\Backed;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Amenities;
use App\Services\Admin\AmenityService;

class AmenityController extends Controller
{
    protected $amenity;
    public function __construct(AmenityService $amser) {
        $this->amenity = $amser;
    }
    /* Amenity index */ 
    public function index(Request $request) {
        $amenity = $this->amenity->getAmenity($request->all());
        if($request->ajax()) {
            return response()->json([
                'status' =>true,
                'html' => view('backed.amenity.amenitydata', compact('amenity'))->render(),
            ]);
        }
        return view('backed.amenity.amenities',compact('amenity'));
    }
    /* Store amenity */
    public function store(Amenities $req) {
       return $this->amenity->store($req);
    }
    /* Edit list */
    public function edit(Request $request) {
        $id = $request->input('id');

        $amenity = $this->amenity->edit($id);

        if ($amenity) {
            return response()->json([
                'status' => true,
                'msg'    => 'Amenity data found.',
                'data'   => $amenity
            ]);
        }

        return response()->json([
            'status' => false,
            'msg'    => 'No category data found.'
        ], 404);
    }
    /* Update amenity */
    public function update(Request $request) {
        $result = $this->amenity->update($request->all());
       return $result;
    }
    /* status change amenity */
    public function statusChange(Request $re) {
        return $this->amenity->statusChange($re->all());
    }
    /* Delete multiple amenities */
    public function multipleAmenityDelete(Request $request) {
        $this->amenity->deleteMultipleamenity($request->all());
        return back()->with('success','Amenities deleted successfully');
    }
}
