@php
    $step7= session('step7');
    
@endphp
   <form action="{{ route('step7'); }}" method="post" id="propertyNearBy" enctype="multipart/form-data">
    @csrf
   <div class="multistep-box row">
  
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">  
                            <div class="form-group">
                                <label>Restaurant Information  <span style="color:red">*</span></label>
                                <textarea name="restaurant_info" class="form-control" rows="2" cols="2">@if($step7 && is_array($step7) && !empty($step7['restaurant_info'])) {{ $step7['restaurant_info']}} @endif </textarea>
                                <span id="error-restaurant_info" style="color:red"></span>
                            </div> 
                          </div> 
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding-right:0px">
                                <div class="form-group">
                                    <label>Nearby Locations  <span style="color:red">*</span></label>
                                    <textarea name="near_by_location" class="form-control" rows="2" cols="2">@if($step7 && is_array($step7) && !empty($step7['near_by_location'])) {{ $step7['near_by_location']}} @endif</textarea>
                                    <span id="error-near_by_location" style="color:red"></span>
                                </div> 
                            </div>
                           <div class="clearfix"></div>
                           <div class="col-xs-12 col-md-12 col-lg-12">
                            <h5 style="marin-top:10px">FAQ'S</h5>
                            <hr style="border-top:1px solid #ccc;width:100%;margin-top:5px"/>
                           </div>
                           <div class="clearfix"></div>
                           @if($step7 && is_array($step7) && is_array($step7['question']))
                           @php
                             $answer = $step7['answer'];
                           @endphp
                            @foreach ($step7['question'] as $k =>$que)
                               <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                              <div class="form-group">
                                <label>Question <span style="color:red">*</span></label>
                                <input type="text" name="question[]" class="form-control" value="{{ $que; }}" />
                                <span id="error-question" style="color:red"></span>
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                              <div class="form-group">
                                <label>Answer <span style="color:red">*</span></label>
                                <input type="text" name="answer[]" class="form-control" value="{{ $answer[$k]; }}" />
                                <span id="error-answer" style="color:red"></span>
                              </div>
                           </div>
                          <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
                            <button class="btn btn-primary btnplus" type="button" onclick="return appendFaq()" style="margin-top:30px"><i class="fa fa-plus"></i></button>
                          </div>
                          <div class="clearfix"></div>
                              
                            @endforeach
                           @else
                             <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                              <div class="form-group">
                                <label>Question <span style="color:red">*</span></label>
                                <input type="text" name="question[]" class="form-control" />
                                <span id="error-question" style="color:red"></span>
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                              <div class="form-group">
                                <label>Answer <span style="color:red">*</span></label>
                                <input type="text" name="answer[]" class="form-control" />
                                <span id="error-answer" style="color:red"></span>
                              </div>
                           </div>
                          <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
                            <button class="btn btn-primary btnplus" type="button" onclick="return appendFaq()" style="margin-top:30px"><i class="fa fa-plus"></i></button>
                          </div>
                          <div class="clearfix"></div>
                           @endif
                          
                          <div id="appendFax"></div>
                         
              <center style="margin-top:10px"> <button type="button" style="margin-right:20px" onclick="return previous(3)">Previous</button> <button type="submit" style="background:orange!important;width:15%">Next</button></center>
            </div>
        </form>