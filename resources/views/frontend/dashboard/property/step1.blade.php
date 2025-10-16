@php
    $step1 = session('step1');
@endphp
    
   
   <form action="{{ route('step1'); }}" method="post" id="property" enctype="multipart/form-data">
    @csrf
   <div class="multistep-box row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                    <label>Property Type <span style="color:red">*</span></label>
                    <select name="property_type" class="form-control" required>
                        <option value="">Select property type</option>
                        @foreach ($property_category as $pcat)
                            <option value="{{ $pcat->id; }}" @if($step1 && is_array($step1) && $step1['property_type'] == $pcat->id) selected @endif>{{ $pcat->pcamenity_text; }}</option>
                        @endforeach
                    </select>
                    <span id="error-property_type"></span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                    <label>Property Name <span style="color:red">*</span></label>
                    <input type="text" name="property_name" placeholder="Enter Property Name" @if($step1 && is_array($step1)) value="{{ $step1['property_name']}}" @endif>
                    <span id="error-property_name"></span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="form-group">
                     <label>Booking start year<span style="color:red">*</span></label>
                    <select name="booking_start_year" class="form-control">
                        <option value="">Select Year</option>
                        @for ($i = 1950; $i <=2025; $i++) 
                        <option value="{{ $i }}" @if($step1 && is_array($step1) && $step1['booking_start_year'] == $i) selected @endif>{{ $i }}</option>
                        @endfor
                    </select>
                    <span id="error-booking_start_year"></span>
                </div>
            </div>
             <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Property Built Date <span style="color:red">*</span></label>
                        <select name="property_built_date" class="form-control">
                            <option value="">Select Built Year</option>
                            @for ($i = 1950; $i <=2025; $i++) 
                            <option value="{{ $i }}" @if($step1 && is_array($step1) && $step1['property_built_date'] == $i) selected @endif>{{ $i }}</option>
                                
                            @endfor
                        </select>
                        <span id="error-property_built_date"></span>
                    </div>
                </div>
            <div class="clearfix"></div>
               
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Property Hosted <span style="color:red">*</span></label>
                        <select name="property_hosted" class="form-control">
                            <option value="">Select</option>
                            <option value="Individually" @if($step1 && is_array($step1) && $step1['property_hosted'] == "Individually") selected @endif>Individually</option>
                            <option value="Group" @if($step1 && is_array($step1) && $step1['property_hosted'] == "Group") selected @endif>Group</option>
                        </select>
                        <span id="error-property_hosted"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="form-group">
                       <label>Host stay property <span style="color:red">*</span></label>
                        <select name="host_stay_property" class="form-control">
                            <option value="">Select </option>
                            <option value="yes" @if($step1 && is_array($step1) && $step1['host_stay_property'] == "yes") selected @endif>Yes</option>
                            <option value="no" @if($step1 && is_array($step1) && $step1['host_stay_property'] == "no") selected @endif>No</option>
                            
                        </select>
                        <span id="error-host_stay_propertye"></span>
                    </div>
                </div>
                  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                  a  <div class="form-group">
                        <label>Email <span style="color:red">*</span></label>
                        <input type="text" name="email" placeholder="Enter Email" @if($step1 && is_array($step1)) value="{{ $step1['email']}}" @endif>
                        <span id="error-email"></span>
                    </div>
                </div>
                   <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>State <span style="color:red">*</span></label>
                        <select name="state" class="form-control" id="state">
                            <option value="">Select state</option>
                            @if(count($states) >0) 
                                @foreach ($states as $k =>$state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <span id="error-state"></span>
                    </div>
                </div>
                <div class="clearfix"></div>
                  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>City <span style="color:red">*</span></label>
                        <select name="city" class="form-control" id="city">
                            <option value="">Select city</option>
                            
                        </select>
                        <span id="error-state"></span>
                    </div>
                </div>
              
                  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Mobile No <span style="color:red">*</span></label>
                        <input type="number" name="mobile_no" placeholder="Enter Mobile No" maxlength="12" @if($step1 && is_array($step1)) value="{{ $step1['mobile_no']}}" @endif>
                        <span id="error-mobile_no"></span>
                    </div>
                </div>
                  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Whatsapp no </label>
                        <input type="number" name="whatsapp_no" placeholder="Enter Whatsapp No" maxlength="12" @if($step1 && is_array($step1)) value="{{ $step1['whatsapp_no']}}" @endif>
                        <span id="error-whatsapp_no"></span>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Landline no </label>
                        <input type="number" name="landline_no" placeholder="Enter Landline No" maxlength="8" @if($step1 && is_array($step1)) value="{{ $step1['landline_no']}}" @endif>
                        <span id="error-landline_no"></span>
                    </div>
                </div>  
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label>Postal Address <span style="color:red">*</span></label>
                        <textarea cols="2" rows="2" class="form-control" name="postal_address"></textarea>
                        <span id="error-property_postal_address"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label>Map Location <span style="color:red">*</span></label>
                        <textarea cols="2" rows="2" class="form-control" name="property_location">@if($step1 && is_array($step1)) {{ $step1['property_location']}} @endif</textarea>
                        <span id="error-property_location"></span>
                    </div>
                </div> 
                <div class="clearfix"></div>

               
              <center style="margin-top:10px"> <input type="submit" class="fs_next_btn action-button" value="Next" style="width:15%"/></center>
            </div>
        </form>