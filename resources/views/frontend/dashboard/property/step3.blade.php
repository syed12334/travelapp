@php
    $step2 = session('step3');
@endphp
   <form action="{{ route('step3'); }}" method="post" id="propertyPhotosVideos" enctype="multipart/form-data">
    @csrf
   <div class="multistep-box row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                 <div class="form-group">
                        <label>Upload gallery photos <span style="color:red">*</span></label>
                        <div class="input-images-1"></div> <span id="error-photos"></span>
                    </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="position:relative">
                    <div class="form-group">
                    <label>Youtube link </label>
                    <br />
                    <input type="url" name="youtube_link[]" placeholder="Enter youtube link" style="width:85%;float:left">
                    <span id="error-youtube_link"></span>
                </div>
                <button class="btn btn-primary btnplus" type="button" onclick="return appendYLink()"><i class="fa fa-plus"></i></button>
                <div id="appendYoutube"></div>
            </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"></div> 
                <div class="clearfix"></div>
              <center style="margin-top:10px"> <button type="button" style="margin-right:20px" onclick="return previous(3)">Previous</button> <button type="submit" style="background:orange!important;width:15%">Next</button></center>
            </div>
        </form>

