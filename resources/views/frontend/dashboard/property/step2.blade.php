@php
    $step2 = session('step2');
@endphp
   <form action="{{ route('step2'); }}" method="post" id="propertyPersonalDetails" enctype="multipart/form-data" >
    @csrf
   <div class="multistep-box row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                    <label>Name of host <span style="color:red">*</span></label>
                    <input type="text" name="name_of_host" placeholder="Enter name of host" @if($step2 && is_array($step2)) value="{{ $step2['name_of_host']}}" @endif>
                    <span id="error-name_of_host"></span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label>Email <span style="color:red">*</span></label>
                        <input type="text" name="personal_email" placeholder="Enter Email" @if($step2 && is_array($step2)) value="{{ $step2['personal_email']}}" @endif>
                        <span id="error-personal_email"></span>
                    </div>
                </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label>Mobile Number <span style="color:red">*</span></label>
                        <input type="number" name="personal_mobile_no" placeholder="Enter Mobile No" maxlength="12" @if($step2 && is_array($step2)) value="{{ $step2['personal_mobile_no']}}" @endif>
                        <span id="error-personal_mobile_no"></span>
                    </div>
                </div>
                <div class="clearfix"></div>
               
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label>Whatsapp No </label>
                        <input type="number" name="personal_whatsapp_no" placeholder="Enter Whatsapp No" maxlength="12" @if($step2 && is_array($step2)) value="{{ $step2['personal_whatsapp_no']}}" @endif>
                        <span id="error-personal_whatsapp_no"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                     <label>Language Speak <span style="color:red">*</span></label>
                    <input type="text" name="language_speak" class="form-control" placeholder="Enter language speak" @if($step2 && is_array($step2)) value="{{ $step2['language_speak']}}" @endif/>
                    <span id="error-language_speak"></span>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                     <label>Hosting Since <span style="color:red">*</span></label>
                    <select name="hosting_since" class="form-control">
                        <option value="">Select Year</option>
                        @for ($i = 1950; $i <=2025; $i++) 
                        <option value="{{ $i }}" @if($step2 && is_array($step2) && $step2['hosting_since'] == $i) selected @endif>{{ $i }}</option>

                        @endfor
                    </select>
                    <span id="error-hosting_since"></span>
                </div>
            </div>
            <div class="clearfix"></div>
                
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                     <label>Total porperty <span style="color:red">*</span></label>
                    <input type="number" name="total_num_properties" placeholder="Total porperty" @if($step2 && is_array($step2)) value="{{ $step2['total_num_properties']}}" @endif/>
                    <span id="error-total_num_properties"></span>
                </div>
            </div>
              <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group">
                    <label>Upload Profile Photo <span style="color:red">*</span></label>
                    <input type="file" name="profile_img" />
                    <span id="error-profile_img"></span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                     <label>Property Description <span style="color:red">*</span></label>
                     <textarea cols="2" name="personal_description" rows="2" class="form-control" placeholder="Property description">@if($step2 && is_array($step2)) {{ $step2['personal_description']}} @endif</textarea>
                    <span id="error-personal_description"></span>
                </div>
            </div>
            <div class="clearfix"></div>               
              <center style="margin-top:10px"> <button type="button" style="margin-right:20px" onclick="return previous(2)">Previous</button> <button type="submit" style="background:orange!important;width:15%">Next</button></center>
            </div>
        </form>

