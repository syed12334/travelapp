@extends('layouts.dashboard')
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
       <main id="main">
            <section class="profile-dashboard">
                <div id="multistep_form">
                    <!-- progressbar -->
                    <ul id="progress_header">
                        <li ></li>
                        <li ></li>
                        <li ></li>
                        <li ></li>
                        <li ></li>   
                        <li></li> 
                        <li class="active"></li> 
                    </ul>
                    @include('frontend.dashboard.property.step7')
                </div>
            </section>
        </main>
@endsection
@push('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>       
<script>
        $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$(document).ready(function() {
                /* Summernote*/
                 $('textarea').summernote({
                    height: 200,
                 });
              /* Property photos & videos details*/
              $("#propertyNearBy").validate({
                ignore: [],
                rules: {
                    restaurant_info: { required:true},
                    near_by_location: { required:true},
                    "question[]" :{required:true},
                    "answer[]" :{required:true},
                },
                messages: {
                    restaurant_info: {
                        required: "Please enter restaurant info",
                    },
                    near_by_location: {
                        required: "Please enter near by location",
                    },
                    "question[]": {
                        required: "Please enter faq question",
                    },
                     "answer[]": {
                        required: "Please enter faq answer",
                    },
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
                                window.location.href="{{ route('property-thankyou')}}";
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
                   var fieldId = key.replace(/\./g, '\\.');
				$('#error-'+fieldId).text(val[0]);
               
                  console.log('#error-'+fieldId);
				$("#"+key).addClass('error');
			});
        }

        /* Previous function*/
        function previous(id) {
            window.location.href="{{ route('stepsixview')}}";
        }
       
      /* Append Room amenities */
        var i =1;
        function appendFaq() {
            i++;
            var data = "<div class='row' id='removeY"+i+"' style='margin-top:10px'>";
                data +='<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5"><div class="form-group"><label>Question <span style="color:red">*</span></label><input type="text" name="question['+i+']" class="form-control" /><span id="error-question.'+i+'" style="color:red"></span></div></div>';                
                data +='<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5"><div class="form-group"><label>Answer <span style="color:red">*</span></label><input type="text" name="answer['+i+']" class="form-control" /><span id="error-answer.'+i+'" style="color:red"></span></div></div>';                
                data +='<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2"><button class="btn btn-primary btnplus" type="button" onclick="return appendFaq()" style="margin-top:30px;margin-right:5px"><i class="fa fa-plus"></i></button><button class="btn btn-danger btnplus" type="button" onclick="return removeFaq('+i+')" style="margin-top:30px"><i class="fa fa-minus"></i></button></div>';
                data +='<div class="clearfix"></div>';
                data +="</div>";
            $('#appendFax').append(data);
        }
        /* Remove faq */
        function removeFaq(id) {
                $("#removeY"+id).fadeOut(500, function () { $("#removeY"+id).remove(); });
        }
    </script>
@endpush