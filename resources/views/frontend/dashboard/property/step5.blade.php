@php
    $step5 = session('step5');
 
@endphp
   <form action="{{ route('step5'); }}" method="post" id="propertyRoomCategory" enctype="multipart/form-data">
    @csrf
   <div class="multistep-box row">
    @if(isset($step5) && !empty($step5))
      @foreach($step5['room_category'] as $k => $val)
      <div class="row" id="removeY{{ $val }}">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button class="btn btn-danger" type="button" onclick="return removeRoom({{ $val }})" style="float:right"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-primary btnplus" type="button" onclick="return appendRoomLink()" style="float:right;margin-right:5px"><i class="fa fa-plus"></i></button>

                          </div>
                          <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">  
                            <div class="form-group">
                                <label>Room Categories  <span style="color:red">*</span></label>
                                <select name="room_category[{{ $k }}]" class="form-control rooms" data-index="0">
                                    <option value="">Select room</option>
                                    @if(count($room_category) >0)
                                        @foreach ($room_category as $room)
                                            <option value="{{ $room->id; }}" @if($step5 && is_array($step5) && $val == $room->id) selected @endif>{{ $room->rooms; }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span id="error-room_category" style="color:red"></span>
                            </div> 
                          </div> 
                           <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="padding-right:0px">
                                <div class="form-group">
                                    <label>Occupancy <span style="color:red">*</span></label>
                                    <select name="quad_room[{{ $k }}]" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Single" @if($step5 && is_array($step5) && is_array($step5['quad_room']) && $step5['quad_room'][$k] == "Single") selected @endif>Single</option>
                                        <option value="Double" @if($step5 && is_array($step5) && is_array($step5['quad_room']) && $step5['quad_room'][$k] == "Double") selected @endif>Double</option>
                                        <option value="Twin" @if($step5 && is_array($step5) && is_array($step5['quad_room']) && $step5['quad_room'][$k] == "Twin") selected @endif>Twin</option>
                                        <option value="Triple" @if($step5 && is_array($step5) && is_array($step5['quad_room']) && $step5['quad_room'][$k] == "Triple") selected @endif>Triple</option>
                                        <option value="Quad" @if($step5 && is_array($step5) && is_array($step5['quad_room']) && $step5['quad_room'][$k] == "Quad") selected @endif>Quad</option>
                                    </select>
                                    <span id="error-quad_room" style="color:red"></span>
                                </div>
                            </div>
                          <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="padding-right:0px">
                            <div class="form-group">
                                <label>Mention no of rooms  <span style="color:red">*</span></label>
                                <input type="number" class="form-control" name="no_of_rooms[{{ $k }}]" value="{{$step5['no_of_rooms'][$k];}}"/>
                                <span id="error-no_of_rooms" style="color:red"></span>
                            </div> 
                          </div>
                           <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="padding-right:0px">
                            <div class="form-group">
                                <label>Price  <span style="color:red">*</span></label>
                                <input type="number" class="form-control" name="price[{{ $k }}]" value="{{$step5['price'][$k];}}"/>
                                <span id="error-price" style="color:red"></span>
                            </div> 
                          </div>
                          <div class="clearfix"></div>
                           <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-right:0px">
                            <div class="form-group">
                                <label>Tax  <span style="color:red">*</span></label>
                                <input type="number" class="form-control" name="tax[{{ $k }}]" value="{{$step5['tax'][$k];}}"/>
                                <span id="error-tax" style="color:red"></span>
                            </div> 
                          </div>
                          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-right:0px">
                            <div class="form-group">
                                <label>Discount  <span style="color:red">*</span></label>
                                <input type="number" class="form-control" name="discount[{{ $k }}]" value="{{$step5['discount'][$k];}}"/>
                                <span id="error-discount" style="color:red"></span>
                            </div> 
                          </div>
                          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label>Room Image <span style="color:red">*</span></label>
                                <input type="file" name="room_img[{{ $k }}]"  class="form-control" accept=".jpg,.jpeg,.png,.PNG,.JPG,.JPEG"/>
                                <span id="error-room_img" style="color:red"></span>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Rate inclusion <span style="color:red">*</span></label>
                                <textarea cols="2" rows="2" id="rate_inclusion" name="rate_inclusion[{{ $k }}]">{{$step5['rate_inclusion'][$k];}}</textarea>
                            </div>
                          </div>
      </div>
        
                          <div class="row" id="getAmenities{{ $val }}">
                              @if(is_array($step5['room_amenity']) && !empty($step5['room_amenity']) && count($step5['room_amenity'][$k]) >0)
                                  <div class="form-group row">
                    <label>Room amenities</label>

                        @if(count($room_amenities) >0) 
                        @foreach ($room_amenities as $ramenity)
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">  
                                    <div style="float:left"><input type="checkbox" name="room_amenity[{{ $k }}][]" value="{{ $ramenity->id }}" @if($step5 && is_array($step5) &&  in_array($ramenity->id,$step5['room_amenity'][$k])) checked @endif /> 
                                        <span style="margin-right:10px;font-size:12px;color:#000">{{ $ramenity->amenity_text }} </span>
                                    </div> 
                                    <select name="room_category_no_of_am[{{ $k }}][]" class="form-control" style="width:50px;height:20px;padding:5px">
                                        <option value="">Select</option>
                                        @for($i =0;$i <=10;$i++)
                                            <option value="{{ $i }}" 
                                            @if($step5 && is_array($step5['room_category_no_of_am'][$k]) && count($step5['room_category_no_of_am'][$k]) >0)
                                                  @foreach ($step5['room_amenity'][$k] as $l => $hs)
                                                      @if($i ==$step5['room_category_no_of_am'][$k][$l]) 
                                                        selected
                                                      @endif
                                                  @endforeach
                                               
                                             @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                        @endforeach
                    @endif
                            </div>
                          @endif
                          <div id="appendRoomCate"></div>
                          </div>
                          
        
      @endforeach
    @else
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button class="btn btn-primary btnplus" type="button" onclick="return appendRoomLink()" style="margin-top:0px;float:right"><i class="fa fa-plus"></i> Add More</button>
                          </div>
                          <div class="clearfix"></div>
                         <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">  
                            <div class="form-group">
                                <label>Room Categories  <span style="color:red">*</span></label>
                                <select name="room_category[]" class="form-control rooms" data-index="0">
                                    <option value="">Select room</option>
                                    @if(count($room_category) >0)
                                        @foreach ($room_category as $room)
                                            <option value="{{ $room->id; }}">{{ $room->rooms; }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span id="error-room_category" style="color:red"></span>
                            </div> 
                          </div> 
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="padding-right:0px">
                                <div class="form-group">
                                    <label>Occupancy<span style="color:red">*</span></label>
                                    <select name="quad_room[]" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Single">Single</option>
                                        <option value="Double">Double</option>
                                        <option value="Twin">Twin</option>
                                        <option value="Triple">Triple</option>
                                    </select>
                                    <span id="error-quad_room" style="color:red"></span>
                                </div>
                            </div>

                           <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="padding-right:0px">
                            <div class="form-group">
                                <label>Mention no of rooms  <span style="color:red">*</span></label>
                                <input type="number" class="form-control" name="no_of_rooms[]"/>
                                <span id="error-no_of_rooms" style="color:red"></span>
                            </div> 
                          </div>
                           <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Price <span style="color:red">*</span></label>
                                    <input type="number" name="price[]" class="form-control" />
                                    <span id="error-price" style="color:red"></span>
                                </div>
                          </div>
                         
                         
                          <div class="clearfix"></div>

                          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Tax <span style="color:red">*</span></label>
                                    <input type="number" name="tax[]" class="form-control" />
                                    <span id="error-tax" style="color:red"></span>
                                </div>
                          </div>
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Discount <span style="color:red">*</span></label>
                                    <input type="number" name="discount[]" class="form-control" />
                                    <span id="error-discount" style="color:red"></span>
                                </div>
                          </div>
                           <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label>Room Image <span style="color:red">*</span></label>
                                <input type="file" name="room_img[]"  class="form-control" accept=".jpg,.jpeg,.png,.PNG,.JPG,.JPEG"/>
                                <span id="error-room_img" style="color:red"></span>
                            </div>
                          </div>
                           <div class="clearfix"></div>
                           <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="form-group">
                                    <label>Rate Inclusion <span style="color:red">*</span></label>
                                    <textarea name="rate_inclusion[]" class="form-control" id="rate_inclusion"></textarea>
                                    <span id="error-rate_inclusion" style="color:red"></span>
                                </div>
                           </div>
                           <div class="clearfix"></div>
                          <div class="row" id="getAmenities0"></div>
                        <div id="appendRoomCate"></div>
                    @endif
              <center style="margin-top:10px"> <button type="button" style="margin-right:20px" onclick="return previous(3)">Previous</button> <button type="submit" style="background:orange!important;width:15%">Next</button></center>
            </div>
        </form>