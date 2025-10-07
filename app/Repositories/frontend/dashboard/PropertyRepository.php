<?php

namespace App\Repositories\frontend\dashboard;
use App\Models\Pamenity;
use App\Models\Property;
use App\Models\Property_category;
use App\Models\Room_category;
use App\Models\Amenity;

class PropertyRepository
{
    public $property;
    public $property_category;
    public $property_amenity;
    public $room_category;
    public $room_amenity;
    public function __construct(Amenity $ameni, Property $pro,Property_category $pcate,Pamenity $pame,Room_category $rcat)
    {
        $this->property = $pro;
        $this->property_category = $pcate;
        $this->property_amenity = $pame;
        $this->room_category = $rcat;
        $this->room_amenity = $ameni;
    }
    /* Store property list */
    public function store($property) {
        return $this->property->create($property);
    }
    /* Get all property categories */
    public function getAllPcategories(){
        return $this->property_category->orderBy('id','desc')->get();
    }
     /* Get all property amenities */
    public function getAllProAmenities(){
        return $this->property_amenity->orderBy('id','desc')->get();
    }
    /* Get room category */
    public function getAllRoomCate() {
        return $this->room_category->orderBy('id','desc')->get();
    }
    /* Get room amenities */
    public function getAllRoomAmenity() {
        return $this->room_amenity->orderBy('id','desc')->get();
    }
}
