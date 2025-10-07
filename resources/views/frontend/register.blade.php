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
                                <h1 class="title">User Register</h1>
                                <ul class="breadcumb-list flex-five">
                                    <li><a href="{{ url('/'); }}">Home</a></li>
                                    <li><span>User Register</span></li>
                                </ul>
                                <img class="bcrumb-ab" src="assets/images/page/mask-bcrumb.png" alt="">
                            </div>
                        </div>

                    </div>
                </section>

                <section class="login">
                    <div class="tf-container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-wrap flex">
                                    <div class="image">
                                        <img src="assets/images/page/sign-up.jpg" alt="image">
                                    </div>
                                    
                                        <form action="{{ route('storeuser'); }}" id="register" class="login-user" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-wrap">
                                                        <label>Name <span style="color:red">*</span></label>
                                                        <input type="text" placeholder="Enter your name" name="name">
                                                    </div>
                                                    @error('name')
                                                        <p style="color:red;margin-top:-14px">{{ $message }}</p>
                                                    @enderror

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-wrap">
                                                        <label>Email <span style="color:red">*</span></label>
                                                        <input type="email" placeholder="Enter your email" name="email">
                                                    </div>
                                                    @error('email')
                                                        <p style="color:red;margin-top:-14px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-wrap">
                                                        <div class="flex-two">
                                                            <label>Password</label>
                                                        </div>
                                                        <input type="password" placeholder="Enter your password*" name="password">
                                                    </div>
                                                     @error('password')
                                                        <p style="color:red;margin-top:-14px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                   <div class="col-lg-6">
                                                    <div class="input-wrap">
                                                        <div class="flex-two">
                                                            <label>Confirm password</label>
                                                        </div>
                                                        <input type="password" placeholder="Enter your confirm password*" name="password_confirmation">
                                                    </div>
                                                      @error('password_confirmation')
                                                        <p style="color:red;margin-top:-14px">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                        <div class="col-lg-6">
                                                            <div class="input-wrap">
                                                                <div class="flex-two">
                                                                    <label>Gender</label>
                                                                </div>
                                                                <select name="gender" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option value="1">Male</option>
                                                                    <option value="2">Female</option>
                                                                    <option value="3">Other</option>
                                                                </select>
                                                    </div>

                                                </div>
                                                <div class="col-lg-6"></div>
                                                   <div class="col-lg-12 mb-40">
                                                    <div class="input-wrap-social ">
                                                        <span class="or">or</span>
                                                        <div class="flex-three">
                                                             <a href="{{ route('googleredirect'); }}" class="login-social flex-three btn">
                                                                <img src="{{ asset('assets/images/page/gg.png')}}" alt="image" style="width:25px;margin-right:10px">
                                                            </a>
                                                         
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-30">
                                                    <button type="submit " class="btn-submit" style="width:100%">Register</button>
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

