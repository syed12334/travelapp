@extends('layouts.dashboard')
@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
<style>
    body {
    display: inline-block;
    width: 100%;
    height: 100vh;
    overflow: hidden;
    background-image: url("https://img1.akspic.com/image/80377-gadget-numeric_keypad-input_device-electronic_device-space_bar-3840x2160.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    margin: 0;
    font-weight: 400;
    font-family: 'Roboto', sans-serif;
}
#step2 {
    display:none;
}
label {
    font-size:13px!important;
    font-weight:bold!important;
    text-align:left!important;
    margin-bottom:0px!important
}
.has-dashboard .profile-dashboard {
    padding:20px 10px!important
}
body:before {
    content: "";
    display: block;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}
.main {
    position: absolute;
    left: 0;
    right: 0;
    top: 30px;
    margin: 0 auto;
    height: 515px;
}
input:-internal-autofill-selected {
    background-color: #fff !important;
}
select {
    padding:17px!important
}

#multistep_form {
    width: 100%;
    position: relative;
    height: 100%;
    z-index: 999;
    opacity: 1; 
    visibility: visible; 
}
/*progress header*/
#progress_header {
    overflow: hidden;
    margin: 0px 0px 20px 0px;
    padding: 0;
}
#progress_header li {
    list-style-type: none;
    width: 16.66%;
    float: left;
    position: relative;
    font-size: 16px;
    font-weight: bold;
    font-family: monospace;
    color: #fff;
    text-transform: uppercase;
    text-align:center
}
#progress_header li:after {
        width: 160px;
    line-height: 30px;
    display: block;
    font-size: 12px;
    color: #000;
    font-family: monospace;
    background-color: #fff;
    margin: 0 auto;
    background-repeat: no-repeat;
    font-weight: bold;
}
#progress_header li:nth-child(1):after {
    content: "PROPERTY DETAILS";
}
#progress_header li:nth-child(2):after {
    content: "PERSONAL DETAILS";
}
#progress_header li:nth-child(3):after {
    content: "PHOTOS & VIDEOS";
}
#progress_header li:nth-child(4):after {
    content: "LOCATION";
}
#progress_header li:nth-child(5):after {
    content: "AMENITIES";
}
#progress_header li:nth-child(6):after {
    content: "MEALS,PRICING AVAIL";
}
#progress_header li:before {
    content: '';
    width: 100%;
    height: 5px;
    background: #fff;
    position: absolute;
    left: -50%;
    top: 50%;
    z-index: -1;
}
#progress_header li:first-child:before {
    content: none;
}
#progress_header li.active:before, 
#progress_header li.active:after {
    background-image: linear-gradient(to right top, #35e8c3, #36edbb, #3df2b2, #4af7a7, #59fb9b) !important;
    color: #fff !important;
    transition: all 0.5s;
}


/*Input and Button*/
.multistep-box {
    background: white;
    border: 0 none;
    border-radius: 3px;
    box-shadow: 1px 1px 55px 3px rgba(255, 255, 255, 0.4);
    padding: 10px 20px;
    box-sizing: border-box;
    width: 100%;
    margin: 0 5px;
    position: relative;
}
.multistep-box:not(:first-of-type) {
    display: none;
}
.form-group {
    margin-bottom:10px
}
.multistep-box p {
    margin: 0 0 12px 0;
    text-align: left;
}
.multistep-box span {
    font-size: 12px;
    color: #FF0000;
}

input:focus, textarea:focus {
    box-shadow: inset 0px 0px 50px 2px rgb(0,0,0,0.1);
}
input.box_error, textarea.box_error {
    border-color: #FF0000;
    box-shadow: inset 0px 0px 50px 2px rgb(255,0,0,0.1);
}
input.box_error:focus, textarea.box_error:focus {
    box-shadow: inset 0px 0px 50px 2px rgb(255,0,0,0.1);
}
p.nxt-prev-button {
    margin: 25px 0 0 0;
    text-align: center;
}
.action-button {
    width: 100px;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 1px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 0 5px;
    background-image: linear-gradient(to right top, #35e8c3, #36edbb, #3df2b2, #4af7a7, #59fb9b);
    transition: all 0.5s;
}
.action-button:hover, 
.action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #6ce199;
}


</style>
@endpush
@section('content')
       <main id="main">
                    <section class="profile-dashboard">
                        
                        {{-- <form action="https://themesflat.co/" id="propertyAdd" class="form-add-tour" >
                            @csrf
                           @include('frontend.dashboard.property.step1')

                        </form> --}}

                        <div id="multistep_form">
            <!-- progressbar -->
            <ul id="progress_header">
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>   
                        <li></li> 
                   
              
            </ul>
        
         @if(request('step') ==2 && session()->has('step1')) 
        
            <div id="step2">
                    @include('frontend.dashboard.property.step2')
            </div>
        @elseif(request('step')== 1 && session()->has('step1'))
         <div id="step1">
                     @include('frontend.dashboard.property.step1')
            </div>
        @else
        <div id="step1">
                     @include('frontend.dashboard.property.step1')
            </div>
            @endif
           
        </div>


                    </section>
                </main>
@endsection

@push('script')
          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
            <script type="text/javascript" src="{{ asset('app/js/property.js'); }}"></script>
                 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
            
<script>
   
/* Dropify js*/
    $('.dropify').dropify();
        $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			/* Property data found*/
			$(document).ready(function() {
			  $("#property").validate({
				rules: {
                    property_name:{
                        required: true,
                    },
                     booking_start_year:{
                        required: true,
                    },
                     property_built_date:{
                        required: true,
                    },
                     property_hosted:{
                        required: true,
                    },
                     host_stay_property:{
                        required: true,
                    },
                     mobile_no:{
                        required: true,
                        number: true 
                    },
					email: {
						required: true,
                        email:true
					},
                    whatsapp_no:{
                        number: true 
                    },
                    landline_no: {
                        number: true 
					} 
				},
				messages: {
					email: {
						required: "Please enter email",
                        email:"Please enter valid email"
					},
                    whatsapp_no:{
                        integer:"Only numbers are allowed"
                    },
                    property_name:{
                        required:"Property name is required"
                    },
                    booking_start_year : {
                        required:"Booking start date is required"
                    },
                     property_built_date : {
                        required:"Property built date is required"
                    },
                     property_hosted : {
                        required:"Property hosted is required"
                    },
                     host_stay_property : {
                        required:"Host stay property is required"
                    },
                     mobile_no : {
                        required:"Mobile no is required",
                        integer : "Only numbers are allowed"
                    },
                     landline_no : {
                        integer:"Landline no is required"
                    }

				},
				submitHandler: function (form) {
					var formData = new FormData(form);
					$.ajax({
						url: form.action,
						method: form.method,
						data: formData,
						processData: false,
						contentType: false,
						success: function (res) {
							if(res.status == true) {
                                $("#step1").hide();
                                $("#step2").show();
                                $("li").removeClass('active');
                                $("li:nth-child(2)").addClass('active');
                                window.location.href="{{ url('property-add?step=2')}}";
							}else if(res.status ==422) {
                                getErrors(res.errors);
							}
							else if(res.status =="false") {
								$("#errorMsg").html('<div class="alert alert-danger" style="top:5%!important">'+res.msg+'</div>');
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {
							let msg = "Something went wrong!";
							switch (jqXHR.status) {
								case 400:
									msg = "Bad Request!";
									break;
								case 401:
									msg = "Unauthorized! Please log in.";
									break;
								case 403:
									msg = "Access denied or token error!";
									break;
								case 404:
									msg = "Requested resource not found!";
									break;
								case 419:
									msg = "Page expired. Please refresh and try again.";
									break;
								case 422:
									msg = "Validation failed!";
									break;
								case 429:
									msg = "Too many requests. Login limit exceeded!";
									break;
								case 500:
									msg = "Internal Server Error!";
									break;
								case 503:
									msg = "Service unavailable. Please try again later.";
									break;
								default:
									msg = textStatus + " - " + errorThrown;
									break;
							}
							$("#errorMsg").html(`<div class="alert alert-danger" style="top:5%!important">${msg}</div>`);
						}
					});
				}
			});

              /* Property personal details*/
              $("#propertyPersonalDetails").validate({
                rules: {
                    name_of_host:{
                        required: true,
                    },
                     language_speak:{
                        required: true,
                    },
                     hosting_since:{
                        required: true,
                    },
                     total_num_properties:{
                        required: true,
                    },
                     personal_description:{
                        required: true,
                    },
                    // profile_img:{
                    //     required: true,
                    //     extension: "jpg|jpeg|png|gif"
                    // },
                     mobile_no:{
                        required: true,
                    },
                    email: {
                        required: true,
                        email:true
                    },
                    whatsapp_no:{
                        number: true 
                    },
                    landline_no: {
                        number: true 
					} 
                },
                messages: {
                    email: {
                        required: "Please enter email",
                        email:"Please enter valid email"
                    },
                    whatsapp_no:{
                        integer : "Only numbers are allowed"
                    },
                    name_of_host:{
                        required:"Name of host is required"
                    },
                    language_speak : {
                        required:"Language is required"
                    },
                     hosting_since : {
                        required:"Hosting since is required"
                    },
                     total_num_properties : {
                        required:"Total property is required"
                    },
                     personal_description : {
                        required:"Personal description is required"
                    },
                     profile_img : {
                        required:"Profile image is required",
                        extension : "Only jpg,jpeg,png are allowed"
                    },
                     mobile_no : {
                        required:"Mobile no is required",
                        integer : "Only numbers are allowed"
                    },
                     landline_no : {
                        integer : "Only numbers are allowed"
                    }

                },
                submitHandler: function (form) {
                    var formData = new FormData(form);
                    $.ajax({
                        url: form.action,
                        method: form.method,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            if(res.status == true) {
                                $("#step1").hide();
                                $("#step2").hide();
                                $("#step3").show();
                                $("li").removeClass('active');
                                $("li:nth-child(3)").addClass('active');
                            }else if(res.status ==422) {
                                getErrors(res.errors);
                            }
                            else if(res.status =="false") {
                                $("#errorMsg").html('<div class="alert alert-danger" style="top:5%!important">'+res.msg+'</div>');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            let msg = "Something went wrong!";
                            switch (jqXHR.status) {
                                case 400:
                                    msg = "Bad Request!";
                                    break;
                                case 401:
                                    msg = "Unauthorized! Please log in.";
                                    break;
                                case 403:
                                    msg = "Access denied or token error!";
                                    break;
                                case 404:
                                    msg = "Requested resource not found!";
                                    break;
                                case 419:
                                    msg = "Page expired. Please refresh and try again.";
                                    break;
                                case 422:
                                    msg = "Validation failed!";
                                    break;
                                case 429:
                                    msg = "Too many requests. Login limit exceeded!";
                                    break;
                                case 500:
                                    msg = "Internal Server Error!";
                                    break;
                                case 503:
                                    msg = "Service unavailable. Please try again later.";
                                    break;
                                default:
                                    msg = textStatus + " - " + errorThrown;
                                    break;
                            }
                            $("#errorMsg").html(`<div class="alert alert-danger" style="top:5%!important">${msg}</div>`);
                        }
                    });
                }
            });
		});

        /* Input dynamic values*/
        function getErrors(errors) {
            $.each(errors, function (key, val) {
				$('#error-' + key).text(val[0]);
				$("#"+key).addClass('error');
                
			});
        }

        /* Previous function*/
        function previous(id) {
            $("#step1").show();
            $("#step2").hide();
            $("li").removeClass('active');
            $("li:nth-child("+id+")").addClass('active');
            window.location.href="{{ url('property-add?step=1')}}";
        }
    </script>
@endpush