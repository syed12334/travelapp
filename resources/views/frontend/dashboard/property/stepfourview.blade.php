@extends('layouts.dashboard')

@section('content')
       <main id="main">
                    <section class="profile-dashboard">
                  

                        <div id="multistep_form">
            <!-- progressbar -->
            <ul id="progress_header">
                        <li ></li>
                        <li ></li>
                        <li ></li>
                        <li class="active"></li>
                        <li></li>   
                        <li></li> 
                   
              
            </ul>
        
             @include('frontend.dashboard.property.step4',['property_amenity'=>$property_amenity])
           
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

			$(document).ready(function() {
              /* Property photos & videos details*/
              $("#propertyAmenities").validate({
                ignore: [],
                rules: {
                    property_amenity: { required:true}
                },
                messages: {
                    property_amenity: {
                        required: "Please select atleast one amenity",
                    }
                },
                submitHandler: function (form) {
                    let formData = new FormData(form);

                    $.ajax({
                        url: form.action,
                        method: form.method,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            console.log(res);
                            if(res.status == true) {
                                window.location.href="{{ route('stepfiveview')}}";
                            }
                            else if(res.status ==422) {
                                getErrors(res.errors);
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

        /* Previous function*/
        function previous(id) {
            window.location.href="{{ route('stepthreeview')}}";
        }
      
        
    </script>
@endpush