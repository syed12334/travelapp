<div class="form-group row">
                    <label>Room amenities</label>

                        @if(count($room_amenities) >0) 
                        @foreach ($room_amenities as $ramenity)
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">  
                                    <div style="float:left"><input type="checkbox" name="room_amenity[{{ $index }}][]" value="{{ $ramenity->id }}" /> 
                                        <span style="margin-right:10px;font-size:12px;color:#000">{{ $ramenity->amenity_text }} </span>
                                    </div> 
                                    <select name="no_of_am[{{ $index }}][]" class="form-control" style="width:50px;height:20px;padding:5px">
                                        <option value="">Select</option>
                                        @for($i =0;$i <=10;$i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                        @endforeach
                    @endif
                            </div>