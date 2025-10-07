@php
    $step4 = session('step4');
@endphp
   <form action="{{ route('step4'); }}" method="post" id="propertyAmenities" enctype="multipart/form-data">
    @csrf
   <div class="multistep-box row">
                 <div class="form-group row">
                        <label>Amenities list <span style="color:red">*</span></label>
                        @if(count($property_amenity) >0)
                            @foreach ($property_amenity as $propamenity)
                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">  
                                    <div style="float:left"><input type="checkbox" name="property_amenity[]" value="{{ $propamenity->id }}" @if($step4 && is_array($step4) &&  in_array($propamenity->id,$step4['property_amenity'])) checked @endif/> 
                                        <span style="margin-right:10px;font-size:12px;color:#000">{{ $propamenity->pamenity_text }} </span>
                                    </div> 
                                    <select name="no_of_am[]" class="form-control" style="width:50px;height:20px;padding:5px">
                                        <option value="">Select</option>
                                        @for($i =0;$i <=10;$i++)
                                            <option value="{{ $i }}" @if($step4 && is_array($step4) && in_array($i,$step4['no_of_am'])) selected @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            @endforeach
                        @endif
                        <span id="error-property_amenity" style="color:red"></span>
                    </div>  
          
            
              <center style="margin-top:10px"> <button type="button" style="margin-right:20px" onclick="return previous(3)">Previous</button> <button type="submit" style="background:orange!important;width:15%">Next</button></center>
            </div>
        </form>

