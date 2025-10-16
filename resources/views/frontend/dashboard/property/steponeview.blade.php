
@extends('layouts.dashboard')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

       <main id="main">
                    <section class="profile-dashboard">
                        
                    

                        <div id="multistep_form">
            <!-- progressbar -->
            <ul id="progress_header">
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>   
                        <li></li> 
                        <li></li> 
                   
              
            </ul>
                    <div id="step1">
                            {{-- @include('frontend.dashboard.property.step1',['property_category'=>$property_category]) --}}
                            <x-step-one  :pcategory="$property_category" :state="$states" :city="$cities"/>
                    </div>
        </div>


                    </section>
                </main>
@endsection

@push('script')
          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
            
<script>

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
                    property_location: {
                        required:true
                    },
                    whatsapp_no:{
                        number: true 
                    },
                    landline_no: {
                        number: true 
					},
                    state : {
                        required:true
                    },
                    city : {
                        required:true
                    },
                    postal_address : {
                        required:true
                    },
				},
				messages: {
					email: {
						required: "Please enter email",
                        email:"Please enter valid email"
					},
                    property_location:{
                        required:"Property location is required"
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
                    },
                    state : {
                        required:"Please select state"
                    },
                    city : {
                        required:"Please select city"
                    },
                    postal_address : {
                        required:"Please enter postal address"
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
                                window.location.href="{{ route('steptwoview')}}";
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
                                    if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                                        getErrors(jqXHR.responseJSON.errors); 
                                        return;
                                    }
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
     
        /* Fetch city by city*/
        $(document).on("change","#state",function(){
            var state = $(this).val();
            $.ajax({
                url :"{{ route('getCity'); }}",
                method:"post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    state:state
                },
                dataType:"json",
                success:function(res) {
                    if(res.status ==true) {
                        $("#city").html(res.city);
                    }
                }
            });
        });

       
    </script>
@endpush