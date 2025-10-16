@extends('layouts.dashboard')

@section('content')
       <main id="main">
                    <section class="profile-dashboard" style="background:#fff">
                        <div id="multistep_form">
           
                    <div class="row" style="margin:50px 0px">
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2"></div>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <center>
                                <img src="{{ asset('assets/images/rightmark.png') }}" style="width:100px;margin-bottom:20px"/>
                                <h4 style="font-size:27px;line-height:37px">Your property has been submitted . Our team is reviewing it and we shall revert back to you soon.</h4>  
                            </center>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2"></div>
                        <div class="clearfix"></div>
                         
                    </div>
        </div>


                    </section>
                </main>
@endsection
