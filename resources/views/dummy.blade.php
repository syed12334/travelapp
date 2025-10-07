@extends('layouts.app')

@section('content')
<div class="container">
    <div id="step-container">
        {{-- Step 1 --}}
        <div id="step1" class="step">
            <h3>Step 1: Personal Info</h3>
            <form id="form-step1">
                @csrf
                <input type="text" name="name" placeholder="Full Name" class="form-control mb-2">
                <input type="email" name="email" placeholder="Email" class="form-control mb-2">
                <button type="submit" class="btn btn-primary">Next</button>
            </form>
        </div>

        {{-- Step 2 --}}
        <div id="step2" class="step d-none">
            <h3>Step 2: Address Info</h3>
            <form id="form-step2">
                @csrf
                <input type="text" name="address" placeholder="Address" class="form-control mb-2">
                <input type="text" name="city" placeholder="City" class="form-control mb-2">
                <button type="submit" class="btn btn-primary">Next</button>
            </form>
        </div>

        {{-- Step 3 --}}
        <div id="step3" class="step d-none">
            <h3>Step 3: Account Setup</h3>
            <form id="form-step3">
                @csrf
                <input type="password" name="password" placeholder="Password" class="form-control mb-2">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control mb-2">
                <button type="submit" class="btn btn-success">Finish</button>
            </form>
        </div>
    </div>

    <div id="alert-box" class="mt-3"></div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    function showStep(step){
        $(".step").addClass("d-none");
        $("#step"+step).removeClass("d-none");
    }

    function handleForm(formId, url){
        $(formId).on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: url,
                method: "POST",
                data: $(this).serialize(),
                success: function(res){
                    if(res.next){
                        showStep(res.next);
                    }
                    if(res.redirect){
                        window.location.href = res.redirect;
                    }
                },
                error: function(xhr){
                    let errors = xhr.responseJSON.errors;
                    let messages = "";
                    $.each(errors, function(key, val){
                        messages += "<div class='alert alert-danger'>"+val[0]+"</div>";
                    });
                    $("#alert-box").html(messages);
                }
            });
        });
    }

    handleForm("#form-step1", "{{ route('register.step1') }}");
    handleForm("#form-step2", "{{ route('register.step2') }}");
    handleForm("#form-step3", "{{ route('register.step3') }}");
});
</script>
@endpush
