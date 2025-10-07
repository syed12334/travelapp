@extends('layouts.dashboard')
@push('style')
<link href="{{ asset('app/css/image-uploader.min.css') }}" />
<style>
    /*! Image Uploader - v1.2.3 - 26/11/2019
 * Copyright (c) 2019 Christian Bayer; Licensed MIT */
 @font-face{font-family:'Image Uploader Icons';src:url(../fonts/iu.eot);src:url(../fonts/iu.eot) format('embedded-opentype'),url(../fonts/iu.ttf) format('truetype'),url(../fonts/iu.woff) format('woff'),url(../fonts/iu.svg) format('svg');font-weight:400;font-style:normal}[class*=iui-],[class^=iui-]{font-family:'Image Uploader Icons'!important;speak:none;font-style:normal;font-weight:400;font-variant:normal;text-transform:none;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.iui-close:before{content:"\e900"}.iui-cloud-upload:before{content:"\e901"}.image-uploader{min-height:10rem;border:2px dashed #C8CBCE;position:relative}.image-uploader.drag-over{background-color:#f3f3f3}.image-uploader input[type=file]{width:0;height:0;position:absolute;z-index:-1;opacity:0}.image-uploader .upload-text{background:#f1f1f1;position:absolute;top:0;right:0;left:0;bottom:0;display:flex;justify-content:center;align-items:center;flex-direction:column}.image-uploader .upload-text i{display:block;font-size:3rem;margin-bottom:.5rem}.image-uploader .upload-text span{display:block}.image-uploader.has-files .upload-text{display:none}.image-uploader .uploaded{background:#fff;padding:.5rem;line-height:0}.image-uploader .uploaded .uploaded-image{display:inline-block;width:calc(16.6666667% - 1rem);padding-bottom:calc(16.6666667% - 1rem);height:0;position:relative;margin:.5rem;background:#f3f3f3;cursor:default}.image-uploader .uploaded .uploaded-image img{width:100%;height:100%;object-fit:cover;position:absolute}.image-uploader .uploaded .uploaded-image .delete-image{display:none;cursor:pointer;position:absolute;top:.2rem;right:.2rem;border-radius:50%;padding:.3rem;line-height:1;background-color:#eb5678;-webkit-appearance:none;border:none}.image-uploader .uploaded .uploaded-image:hover .delete-image{display:block}.image-uploader .uploaded .uploaded-image .delete-image i{display:block;color:#fff;width:1.4rem;height:1.4rem;font-size:16px;line-height:1.4rem}@media screen and (max-width:1366px){.image-uploader .uploaded .uploaded-image{width:calc(20% - 1rem);padding-bottom:calc(20% - 1rem)}}@media screen and (max-width:992px){.image-uploader .uploaded{padding:.4rem}.image-uploader .uploaded .uploaded-image{width:calc(25% - .8rem);padding-bottom:calc(25% - .4rem);margin:.4rem}}@media screen and (max-width:786px){.image-uploader .uploaded{padding:.3rem}.image-uploader .uploaded .uploaded-image{width:calc(33.3333333333% - .6rem);padding-bottom:calc(33.3333333333% - .3rem);margin:.3rem}}@media screen and (max-width:450px){.image-uploader .uploaded{padding:.2rem}.image-uploader .uploaded .uploaded-image{width:calc(50% - .4rem);padding-bottom:calc(50% - .4rem);margin:.2rem}}
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
                        <li ></li>
                        <li class="active"></li>
                        <li></li>
                        <li></li>
                        <li></li>   
                        <li></li> 
                   
              
            </ul>
        
             @include('frontend.dashboard.property.step2')
           
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
                     personal_mobile_no:{
                        required: true,
                    },
                    personal_email: {
                        required: true,
                        email:true
                    },
                    personal_whatsapp_no:{
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
                                window.location.href="{{ route('stepthreeview')}}";
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

        /* Previous function*/
        function previous(id) {
            window.location.href="{{ route('steponeview')}}";
        }
    </script>
@endpush