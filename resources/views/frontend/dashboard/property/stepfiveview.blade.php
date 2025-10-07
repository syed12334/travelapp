@extends('layouts.dashboard')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

  <select id="roomCategory"  class="form-control" style="border-radius: 10px!important" >
                    <option value="">Select room</option>
                      @if(count($room_category) >0)
                                @foreach ($room_category as $room)
                                    <option value="{{ $room->id; }}">{{ $room->rooms; }}</option>
                                @endforeach
                            @endif
                  </select>
       <main id="main">
                    <section class="profile-dashboard">
                  

                        <div id="multistep_form">
            <!-- progressbar -->
            <ul id="progress_header">
                        <li ></li>
                        <li ></li>
                        <li ></li>
                        <li ></li>
                        <li class="active"></li>   
                        <li></li> 
                   
              
            </ul>
        
             @include('frontend.dashboard.property.step5',['room_category'=>$room_category,'room_amenities'=>$room_amenities])
           
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
              $("#propertyRoomCategory").validate({
                ignore: [],
                rules: {
                    "room_category[]": { required:true}
                },
                messages: {
                    "room_category[]": {
                        required: "Please select atleast one room category",
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
                                window.location.href="{{ route('stepsixview')}}";
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
            window.location.href="{{ route('stepfourview')}}";
        }
        /* Room change*/
        $(document).on("change",".rooms",function(e) {
            e.preventDefault();
            var room = $(this).val();
            var index = $(this).data('index');
            $.ajax({
                url :"{{ route('getAmenitiesAjax'); }}",
                method:"post",
                dataType:"json",
                data:{
                    index:index
                },
                success:function(res) {
                    if(res.status ==true) {
                        $('select').select2();
                        $("#getAmenities"+index).html(res.html);
                    }
                }
            });
            
        });
      /* Append Room amenities */
        var i =1;
        function appendRoomLink() {
            i++;
            var data = "<div class='row' id='removeY"+i+"' style='margin-top:10px'>";
                data +='<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3"><div class="form-group"><select name="room_category['+i+']" data-index="'+i+'" class="form-control rooms" id="cateroom'+i+'">'+$("#roomCategory").html()+'</select></div></div>';
                data +='<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="margin-top:0px"><button class="btn btn-primary" type="button" onclick="return appendRoomLink()"><i class="fa fa-plus"></i></button><button class="btn btn-danger" type="button" onclick="return removeRoom('+i+')" style="margin-left:5px"><i class="fa fa-minus"></i></button></div>';
                data +='<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7"></div>';
                data +='<div class="clearfix"></div>';
                data +='<div class="row" id="getAmenities'+i+'"></div>';
            data +="</div>";
            $('select').select2();
            $('#appendRoomCate').append(data);
        }
        /* Remove room categories */
        function removeRoom(id) {
                $("#removeY"+id).fadeOut(500, function () { $("#removeY"+id).remove(); });
        }
        
    </script>
@endpush