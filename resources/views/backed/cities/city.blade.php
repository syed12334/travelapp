@extends('layouts.admin')

@section('title', 'States')

@push('style')
    <style>
        .card-body {
            position :relative;
        }
        .card-body .card-trash i {
            position: absolute;
            top: 10px;
            left: 50px;
            color: red;
            font-size: 15px;
            cursor: pointer;
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 3px;
        }
        img, svg {
            width:20px
        }
        .sm:hidden, span {
            display:none!important
        }
        #name-error {
            background-image: none !important;
            margin-top: 3px;
        }
    </style>
@endpush
 <form action="{{route('cities')}}" method="get" id="getSubmitform">
            <input type="hidden" name="status"  value="{{ request('status')}}" id="status"/>
            <input type="hidden" name="paging"  value="{{ request('paging')}}" id="paging"/>
            <input type="hidden" name="state"  value="{{ request('state')}}" id="state"/>

        </form>
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Cities</h4>
                    <h6>Manage your city</h6>
                </div>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-primary clearform" data-bs-toggle="modal" data-bs-target="#add-amenity">
                    <i class="ti ti-circle-plus me-1"></i>Add City
                </a>
            </div>
        </div>
        <!-- Category List -->
        <div class="card">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success')}}</div>
            @endif
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                <div class="search-set">
                    <div class="search-input">
                        <span class="btn-searchset">
                            <i class="ti ti-search fs-14 feather-search"></i>
                        </span>
                        <input type="search" class="form-control form-control-sm" placeholder="Search">
                    </div>
                </div>

               
                <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                    <div class="dropdown" style="margin-right:10px">
                        <div class="st dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                              States
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            <li onclick="return getStatelist(-1)"><a href="javascript:void(0)" class="dropdown-item rounded-1 ">All</a></li>
                            @foreach ($states as $state)
                                <li onclick="return getStatelist({{ $state->id }})"><a href="javascript:void(0)" class="dropdown-item rounded-1 ">{{ $state->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="dropdown">
                        <div class="st dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                              @if(request('status') ==3) 
                                    {{ "All"}} 
                                    @elseif(request('status') ==1) 
                                    {{"Active"}} 
                                    @elseif(request('status') ==4) 
                                    {{"Inactive"}} 
                                    @else 
                                    {{ "Status" }}
                                    @endif
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end p-3">
                            <li onclick="return getStatuslist(3)"><a href="javascript:void(0)" class="dropdown-item rounded-1 ">All</a></li>
                            <li onclick="return getStatuslist(1)"><a href="javascript:void(0)" class="dropdown-item rounded-1 ">Active</a></li>
                            <li onclick="return getStatuslist(4)"><a href="javascript:void(0)" class="dropdown-item rounded-1 ">Inactive</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body p-0" style="position:relative">
                <form action="{{ route('smultipleCityDelete') }}" method="post">
                    @csrf
                    <div class="card-trash">
                        <button type="submit" class="btn"><i class="fa fa-trash" title="Delete State" style="margin-top:15px"></i></button>
                    </div>
                    <div class="table-responsive" id="amenityListtable">
                        @include('backed.cities.citydata',['cities'=>$cities]);
                    </div>
                </form>
            </div>
        </div>
        <!-- /Category List -->
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="add-amenity" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="page-title">
                        <h4 id="modalTitle">Add City</h4>
                    </div>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="errorMsg"></div>
                <form action="{{ route('cistore') }}" method="post" id="amenityForm">
                    <input type="hidden" name="city_id" id="city_id" >
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Select state<span class="text-danger ms-1">*</span></label>
                            <select class="form-control" name="state" id="state" required>
                                <option value="">Select State</option>
                                @foreach ($states as $state )
                                    <option value="{{ $state->id}}">{{ $state->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="error_state"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Enter city<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter city" required>
                            <span class="text-danger" id="error_name"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="categorySubmitButton">Add City</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});
/* Clear form on click*/ 
$(document).on("click",".clearform",function() {
    $("#amenityForm")[0].reset();
});
$(function () {
 const $form           = $('#amenityForm');
  const listUrl         = "{{ route('ciajaxcitylist') }}";
 const editUrl         = "{{ route('seditCitylist') }}";
const updateUrl       = "{{ route('supdateCitylist') }}";

    /* ---------- jQuery‑Validate ---------- */
    $form.validate({
        rules:    { 
            name: { required: true, minlength: 3 },state:{
            required:true
        } },
        messages: { name: 
            { 
                required: 'Please enter a city',
                minlength: 'Your city name must consist of at least 3 characters'
             },
             state: 
             { 
                required: 'Please select a state'
             } 
            },

        submitHandler: function (form) {
            const fd = new FormData(form);

            $.ajax({
                url:  form.action,
                type: form.method,
                data: fd,
                processData: false,
                contentType: false,

                success(res) {
                    if (res.status == true) {
                        toastr.success(res.msg || 'Saved');
                        $('#add-amenity').modal('hide');
                        refreshList();
                    } else if (res.status === 422) {
                        $.each(res.errors, (k, v) => {
                            $('#error_' + k).text(v[0]);
                            $('#' + k).addClass('error');
                        });
                    } else {
                        toastr.error(res.msg || 'Something went wrong');
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

            return false;   // prevent normal submit
        }
    });

     /* Input dynamic values*/
        function getErrors(errors) {
            $.each(errors, function (key, val) {
				$('#error-' + key).text(val[0]);
				$("#"+key).addClass('error');
                
			});
        }


    /* ---------- Global AJAX error handler ---------- */
    function ajaxFail(jqXHR, textStatus, errorThrown) {
        let msg = 'Something went wrong!';
        if (jqXHR.status === 403) msg = 'Token error! Please try again.';
        else                      msg = textStatus + ' - ' + errorThrown;
        toastr.error(msg);
    }

    /* ---------- Clear form & errors helper ---------- */
    function clearForm() {
        $form[0].reset();
        $('.error').text('');
        $('.is-invalid').removeClass('is-invalid');
    }

    /* ---------- Edit Category (exposed globally) ---------- */
    window.editAmenity = function (id) {
        $.post(editUrl, { id })
         .done(resp => {
             if (resp.status) {
                 const c = resp.data;

                 clearForm();
                 $('#name').val(c.city_name);                 // << proper key
                 $('#state').val(c.state_id);                 // << proper key
                 $('#city_id').val(c.id);
                 $('#modalTitle').text('Edit City');
                 $('#categorySubmitButton').text('Update City');
                 $form.attr({ action: updateUrl, method: 'POST' });
                 $('#add-amenity').modal('show');
             } else {
                 toastr.error(resp.message || 'Unable to load state.');
             }
         })
         .fail(ajaxFail);
    };
});

    /* ---------- List refresh helper ---------- */
    function refreshList() {
         $.ajax({
            url:"{{ route('ciajaxcitylist') }}",
            type: "get",
            success(res) {
                $('#amenityListtable').html(res.html);
            }
        });
    }
function changeAmenityStatus(aid,st,msg) {
    if(confirm(msg)) {
        $.ajax({
            url:"{{ route('cistatusChange') }}",
            type: "post",
                data: {
                    city_id:aid,
                    status :st,
                    msg:msg
                },
                success(res) {
                    if (res.status == true) {
                        toastr.success(res.msg || 'Saved');
                        refreshList();
                    } else if (res.status === 422) {
                        $.each(res.errors, (k, v) => {
                            $('#error_' + k).text(v[0]);
                            $('#' + k).addClass('error');
                        });
                    } else {
                        toastr.error(res.msg || 'Something went wrong');
                    }
                }
        });
    }
}
/* Get status change */
function getStatuslist(status) {
    if(status ==0) {
        $(".st").text('Inactive');
    }
    else if(status ==1) {
        $(".st").text('Active');
    }
    else if(status ==2) {
        $(".st").text('All');
    }
    $("#status").val(status);
    setTimeout(function() {
        $("#getSubmitform").submit();
    },100);
}
/* Search */
$(document).on('keyup',"input[type='search']",function() {
    var search = $(this).val();
    getsearchdata(search);
});
/* Search ajax*/
function getsearchdata(search) {
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:"{{ route('cities');}}",
        type:"GET",
        dataType:"json",
        data:{
            search :search
        },
        cache:false,
        success:function(res) {
            if(res.status==true) {
                $("#amenityListtable").html(res.html); 
            }
        }
    });
}

        /* Delete multiple data*/
        function deleteMultiple(amenity_id) {
        }
         /* Amenity status change */    
    $(document).on("click",'.statusChange',function(e) {
        e.preventDefault();
        var aid = $(this).data('id');
        var st = $(this).data('status');
        var msg = $(this).data('msg');
        if(confirm(msg)) {
            $.ajax({
                url:"{{ route('cistatusChange') }}",
                type: "post",
                    data: {
                        city_id:aid,
                        status :st,
                        msg:msg
                    },
                    success(res) {
                        if (res.status == true) {
                            toastr.success(res.msg || 'Saved');
                            refreshList();
                        } else if (res.status === 422) {
                            $.each(res.errors, (k, v) => {
                                $('#error_' + k).text(v[0]);
                                $('#' + k).addClass('error');
                            });
                        } else {
                            toastr.error(res.msg || 'Something went wrong');
                        }
                    }
            });
        }
    });
     /* Getpaging*/
        $(document).on("change","#getPaging",function() {
            var page = $(this).val();
            $("#paging").val(page);
            setTimeout(function() {
                $("#getSubmitform").submit();
            },100);
        });

        /* Get state change */
function getStatelist(state_id) {
   
    $("#state").val(state_id);
    setTimeout(function() {
        $("#getSubmitform").submit();
    },100);
}
</script>
@endpush

