@php
    $step6 = session('step6');
@endphp
   <form action="{{ route('step6'); }}" method="post" id="propertyHouseRules" enctype="multipart/form-data">
    @csrf
   <div class="multistep-box row">
  
                          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">  
                            <div class="form-group">
                                <label>Check-in  <span style="color:red">*</span></label>
                                <input type="text" name="check_in" class="form-control" @if($step6 && is_array($step6)) value="{{ $step6['check_in']}}" @endif />
                                <span id="error-check_in" style="color:red"></span>
                            </div> 
                          </div> 
                          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">  
                            <div class="form-group">
                                <label>Check-out  <span style="color:red">*</span></label>
                                <input type="text" name="check_out" class="form-control" @if($step6 && is_array($step6)) value="{{ $step6['check_out']}}" @endif/>
                                <span id="error-check_out" style="color:red"></span>
                            </div> 
                          </div>
                          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">  
                            <div class="form-group">
                                <label>Cancellation/prepayment  <span style="color:red">*</span></label>
                                <input type="text" name="cancel_prepay" class="form-control" @if($step6 && is_array($step6)) value="{{ $step6['cancel_prepay']}}" @endif/>
                                <span id="error-cancel_prepay" style="color:red"></span>
                            </div> 
                          </div>
                          <div class="clearfix"></div>
                           <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">  
                            <div class="form-group">
                                <label>Children & beds  <span style="color:red">*</span></label>
                                <input type="text" name="children_beds" class="form-control" @if($step6 && is_array($step6)) value="{{ $step6['children_beds']}}" @endif/>
                                <span id="error-children_beds" style="color:red"></span>
                            </div> 
                          </div> 
                          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">  
                            <div class="form-group">
                                <label>No age restriction  <span style="color:red">*</span></label>
                                <input type="text" name="no_age_restrict" class="form-control" @if($step6 && is_array($step6)) value="{{ $step6['no_age_restrict']}}" @endif/>
                                <span id="error-no_age_restrict" style="color:red"></span>
                            </div> 
                          </div>
                          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">  
                            <div class="form-group">
                                <label>Pets  <span style="color:red">*</span></label>
                                <input type="text" name="pets" class="form-control" @if($step6 && is_array($step6)) value="{{ $step6['pets']}}" @endif/>
                                <span id="error-pets" style="color:red"></span>
                            </div> 
                          </div>
                          <div class="clearfix"></div>
                           <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">  
                            <div class="form-group">
                                <label>Groups  <span style="color:red">*</span></label>
                                <input type="text" name="groups" class="form-control" @if($step6 && is_array($step6)) value="{{ $step6['groups']}}" @endif/>
                                <span id="error-groups" style="color:red"></span>
                            </div> 
                          </div> 
                          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">  
                            <div class="form-group">
                                <label>Accepted payment methods <span style="color:red">*</span></label>
                                <input type="text" name="accept_payment_method" class="form-control" @if($step6 && is_array($step6)) value="{{ $step6['accept_payment_method']}}" @endif/>
                                <span id="error-accept_payment_method" style="color:red"></span>
                            </div> 
                          </div>
                          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">  
                            <div class="form-group">
                                <label>Parties  <span style="color:red">*</span></label>
                                <input type="text" name="parties" class="form-control" @if($step6 && is_array($step6)) value="{{ $step6['parties']}}" @endif/>
                                <span id="error-parties" style="color:red"></span>
                            </div> 
                          </div>
                          <div class="clearfix"></div>
                       

                         
            
              <center style="margin-top:10px"> <button type="button" style="margin-right:20px" onclick="return previous(3)">Previous</button> <button type="submit" style="background:orange!important;width:15%">Next</button></center>
            </div>
        </form>