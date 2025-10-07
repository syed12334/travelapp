@extends('layouts.app')
@push('style')
    <style>
        .input-wrap {
            margin-bottom:15px       }
    </style>
@endpush
@section('content')
    <main id="main">

                <section class="breadcumb-section">
                    <div class="tf-container">
                        <div class="row">
                            <div class="col-lg-12 center z-index1">
                                <h1 class="title">User Login</h1>
                                <ul class="breadcumb-list flex-five">
                                    <li><a href="{{ url('/'); }}">Home</a></li>
                                    <li><span>User Login</span></li>
                                </ul>
                                <img class="bcrumb-ab" src="assets/images/page/mask-bcrumb.png" alt="">
                            </div>
                        </div>

                    </div>
                </section>

                <section class="login">
                    <div class="tf-container">
                        <div class="row">
                            <div id="errorMsg"></div>
                            <div class="col-lg-12">
                                <div class="login-wrap flex">
                                    <div class="image">
                                        <img src="assets/images/page/sign-up.jpg" alt="image">
                                    </div>
                                        
                                        <form action="{{ route('loginuser'); }}" method="post" id="loginForm" class="login-user">
                                            @csrf
                                            <div class="row">
                                              
                                                <div class="col-md-12">
                                                    <div class="input-wrap">
                                                        <label>Email <span style="color:red">*</span></label>
                                                        <input type="email" placeholder="Enter your email" name="email">
                                                    </div>
                                                     <span class="text-danger" id="error_email"></span>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="input-wrap">
                                                        <div class="flex-two">
                                                            <label>Password</label>
                                                        </div>
                                                        <input type="password" placeholder="Enter your password*" name="password">
                                                    </div>
                                                    <span class="text-danger" id="error_password"></span>
                                                </div>
                                                

                                                        

                                                </div>
                                                <div class="col-lg-6"></div>
                                                   <div class="col-lg-6 mb-40">
                                                    <div class="input-wrap-social ">
                                                        <span class="or">or</span>
                                                        <div class="flex-three">
                                                             <a href="{{ route('googleredirect'); }}" class="login-social flex-three btn">
                                                                <img src="{{ asset('assets/images/page/gg.png')}}" alt="image" style="width:25px;margin-right:10px">
                                                            </a>
                                                         
                                                        </div>

                                                    </div>

                                                   

                                                
                                                <div class="col-lg-12 mb-30">
                                                    <button type="submit " class="btn-submit" style="width:100%">Login</button>
                                                    </div>
                                                
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="brand-logo-widget bg-1">
                    <div class="tf-container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="swiper brand-logo overflow-hidden">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="assets/images/page/brand-logo.png" alt="">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/page/brand-logo.png" alt="">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/page/brand-logo.png" alt="">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/page/brand-logo.png" alt="">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/page/brand-logo.png" alt="">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/page/brand-logo.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>


                <section class="mb--93 bg-1">
                    <div class="tf-container">
                        <div class="callt-to-action flex-two z-index3 relative">
                            <div class="callt-to-action-content flex-three">
                                <div class="image">
                                    <img src="assets/images/page/ready.png" alt="Image">
                                </div>
                                <div class="content">
                                    <h2 class="title-call">Ready to adventure and enjoy natural</h2>
                                    <p class="des">Lorem ipsum dolor sit amet, consectetur notted adipisicin</p>
                                </div>
                            </div>
                            <img src="assets/images/page/vector4.png" alt="" class="shape-ab">
                            <div class="callt-to-action-button">
                                <a href="#" class="get-call">Let,s get started</a>
                            </div>
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
			/* Save data*/
			$(document).ready(function() {
			  $("#loginForm").validate({
				rules: {
					email: {
						required: true,
                        email:true
					},
                    password: {
						required: true,
					} 
				},
				messages: {
					email: {
						required: "Please enter email",
                        email:"Please enter valid email"
					},
                    password:{
                        required:"Please enter password"
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
							if(res.status == "true") {
								window.location.href="{{  route('dashboard') }}";
								
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

        function getErrors(errors) {
            $.each(errors, function (key, val) {
				$('#error_' + key).text(val[0]);
				$("#"+key).addClass('error');
			});
        }
    </script>
@endpush