@php
    $step5 = session('step5');
 
@endphp
   <form action="{{ route('step5'); }}" method="post" id="propertyRoomCategory" enctype="multipart/form-data">
    @csrf
   <div class="multistep-box row">
    @if(isset($step5) && !empty($step5))
      @foreach($step5['room_category'] as $k => $val)
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
                          <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <button class="btn btn-primary btnplus" type="button" onclick="return appendRoomLink()" style="margin-top:30px"><i class="fa fa-plus"></i></button>
                          </div>
                          <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7"></div>
                          <div class="clearfix"></div>
                          <div class="row" id="getAmenities0">
                              @if(count($step5['room_amenity'][$k]) >0)
                                  <div class="form-group row">
                    <label>Room amenities</label>

                        @if(count($room_amenities) >0) 
                        @foreach ($room_amenities as $ramenity)
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">  
                                    <div style="float:left"><input type="checkbox" name="room_amenity[{{ $k }}][]" value="{{ $ramenity->id }}" @if($step5 && is_array($step5) &&  in_array($ramenity->id,$step5['room_amenity'][$k])) checked @endif /> 
                                        <span style="margin-right:10px;font-size:12px;color:#000">{{ $ramenity->amenity_text }} </span>
                                    </div> 
                                    <select name="no_of_am[{{ $k }}][]" class="form-control" style="width:50px;height:20px;padding:5px">
                                        <option value="">Select</option>
                                        @for($i =0;$i <=10;$i++)
                                            <option value="{{ $i }}" 
                                            @if($step5 && is_array($step5['no_of_am'][$k]) && count($step5['no_of_am'][$k]) >0)
                                                  @foreach ($step5['room_amenity'][$k] as $l => $hs)
                                                      @if($i ==$step5['no_of_am'][$k][$l]) 
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
                          </div>
                          <div id="appendRoomCate"></div>
        
      @endforeach
    @else
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
                          <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <button class="btn btn-primary btnplus" type="button" onclick="return appendRoomLink()" style="margin-top:30px"><i class="fa fa-plus"></i></button>
                          </div>
                          <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7"></div>
                          <div class="clearfix"></div>
                          <div class="row" id="getAmenities0"></div>
                        <div id="appendRoomCate"></div>
    @endif
                         
            
              <center style="margin-top:10px"> <button type="button" style="margin-right:20px" onclick="return previous(3)">Previous</button> <button type="submit" style="background:orange!important;width:15%">Next</button></center>
            </div>
        </form>