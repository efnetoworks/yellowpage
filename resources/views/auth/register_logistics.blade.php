
@extends('layouts.app')
@section('title', 'Register | ')

@section('content')

<style>
    .input-group input{
        padding: 10px 20px;
        font-size: 15px;
        outline: none;
        height: 50px;
        font-weight: 500;
        border: 1px solid transparent;
        background: #fff;
        box-shadow: 0 0 5px rgb(0 0 0 / 20%);
        border-top-left-radius: 50px;
        border-bottom-left-radius: 50px;
    }
    .input-group .input-group-text{
        border-top-right-radius: 50px;
        border-bottom-right-radius: 50px;
        box-shadow: 5px 0 5px rgb(0 0 0 / 10%);
        border: 1px solid transparent;
        background: #fff;
        outline: none;
        z-index: 1;
    }
    .registerSidebar h6{
        color: #af7615
    }
</style>

    <div class="contact-section">
        <div class="container">
            <div class="row login-box">
                <div class="col-lg-12 align-self-center pad-0">
                    <div class="form-section clearfix">
                        <h3>Create an account for your logistics company</h3>
                        <span>All fields with <span style="color: red;">*</span> are compulsory</span>
                        <p></p>
                        <br>
                        <div class="clearfix"></div>

                          <form action="{{ route('submit_application') }}" method="POST">
                            @csrf
                                {{-- End form for paystack pay --}}
                                {{-- {{ csrf_field() }} --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group form-box">
                                            <label>First Name <span style="color: red;">*</span></label>
                                            <input type="text" id="name" class="input-text @error('first_name') is-invalid @enderror" name="first_name"  autofocus placeholder="First Name" value="{{ old('first_name') }}">

                                            @error('first_name')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group form-box">
                                            <label>Last Name <span style="color: red;">*</span></label>
                                            <input type="text" id="name" class="input-text @error('last_name') is-invalid @enderror" name="last_name"  autofocus placeholder="Last Name" value="{{ old('last_name') }}">

                                            @error('last_name')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="form-group form-box">
                                    <label>Company Name <span style="color: red;">*</span></label>
                                    <input type="text" id="company_name" class="input-text" name="company_name"  autofocus placeholder="Company Name" value="{{ old('company_name') }}">

                                    @error('company_name')
                                    <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group form-box">
                                            <label>Email Address <span style="color: red;">*</span></label>
                                            <input type="text" id="email" placeholder="Company Email Address" class="input-text"  name='email' value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                            <span class="helper-text" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group form-box">
                                            <label>Phone Number <span style="color: red;">*</span></label>
                                            <input type="number" id="phone" placeholder="Phone Number, e.g 080XXXXXXXX" class="input-text" minlength="11" maxlength="11"  name='phone' value="{{ old('phone') }}">
                                            @if ($errors->has('phone'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Password <span style="color: red;">*</span></label>
                                            <div class="input-group mb-3">
                                                <input type="password" id="password" name="password" id="passwordField" class="form-control" placeholder="Password (min: 6 chars)" aria-label="Password" aria-describedby="Password" name='password'>
                                                
                                            </div>
                                            @if ($errors->has('password'))
                                            <span class="helper-text" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Confirm Password <span style="color: red;">*</span></label>
                                            <div class="input-group mb-3">
                                                
                                                <input type="password" id="password" name="password_confirmation" id="passwordField" class="form-control" placeholder="Confirm Password" aria-label="Password" aria-describedby="Password">
                                                
                                            </div>
                                            @if ($errors->has('password_confirmation'))
                                            <span class="helper-text" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                

                                
                            <!--
                                <div class="form-group form-box clearfix">
                                    <input class="input-text" placeholder="Confirm Password" type="password" wire:model='password_confirmation'>
                                </div> -->
                                <div>
                                    <div>
                                        <small>Already have an account? <span><a class="text-danger" href="{{ route('logistics_login') }}"> Click here </a> to login</span></small>
                                    </div>

                                </div>

                                <br>
                                <div>
                                

                                </div>
                          
                                {{-- <div style="padding-top: 15px;">
                                    <label>
                                        <input type="checkbox" name="terms" class="filled-in" wire:model='terms'/>
                                        <span>By registering you accept our <a href="{{route('terms-of-use')}}" target="_blank" style="color: blue">Terms of Use</a> and <a href="{{route('privacy-policy')}}" target="_blank" style="color: blue"> Privacy</a> and agree that we and our selected partners may contact you with relevant offers and services.</span>
                                    </label>
                                    @error('terms')
                                    <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> --}}

                                <div>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>

                                <div id="spinner-container" class="d-none">
                                    <div class="spinner" style=font-size:16px>
                                        <div class="head">

                                        </div>
                                      </div>

                                    <strong>We are creating your account, please wait...</strong>
                                </div>

                                <div id="btn-container" class="form-group clearfix mb-0">
                                    {{-- btn for without pay --}}
                                    {{-- <button type="submit" class="btn-md float-left" style="background-color: #cc8a19; color: #fff">Create Account</button> --}}
                                    {{-- btn for pay --}}
                                    <script src="https://js.paystack.co/v1/inline.js"></script>

                                    <button id="paystack_btn_control1" type="submit" class="btn-md float-right" style="background-color: #cc8a19; color: #fff">Next <i class="fa fa-arrow-right"></i></button>

                                    

                                    <small id="error_msg_paystack1" class="text-danger"></small>
                                </div>
                            </form>

                    </div>
                </div>

                {{-- <div class="col-lg-6 bg-color-15 align-self-center pad-0 p-3 registerSidebar">
                    <div>
                        <img src="{{ asset('promos.svg') }}" alt="" id="probonanza" class="animate__animated" style="width: 80%;margin: 0 auto;display: block;">
                    </div>
                    @if(isset($general_info->register_section_1_title))
                        <h6 class="text-center"> {{ $general_info->register_section_1_title ? $general_info->register_section_1_title : '' }} </h6>
                        <hr>
                        <p>
                            {!! $general_info->register_section_1 ? $general_info->register_section_1 : '' !!}
                        </p>
                    @endif
                    <!--h6 class="text-center">What I gain by joining Estate.ng</h6-->
                    <hr>
                    @if(isset($general_info->register_section_1_title))
                        <h6 class="text-center"> {{ $general_info->register_section_2_title ? $general_info->register_section_2_title : '' }} </h6>
                        <hr>
                        <p>
                            {!! $general_info->register_section_2 ? $general_info->register_section_2 : '' !!}
                        </p>
                    @endif

                    <hr>
                    @if(isset($general_info->register_section_2_title))
                        <h6 class="text-center"> {{ $general_info->register_section_3_title ? $general_info->register_section_3_title : '' }} </h6>
                        <hr>
                        <p>
                            {!! $general_info->register_section_3 ? $general_info->register_section_3 : '' !!}
                        </p>
                    @endif
                   
                </div> --}}
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $('.refresh').click(function(){
            $.ajax({
                type:'GET',
                url:'refreshcaptcha',
                success:function(data){
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>

<script>
    function showPassword() {
        var passField = document.getElementById("passwordField");
        if (passField.type === "password") {
            passField.type = "text";
        } else {
            passField.type = "password";
        }
    }
    $(document).ready(function() {
        setInterval(function() {
            $("#probonanza").toggleClass('animate__flash');
        }, 4000);
    });
</script>

{{-- reg with paystack --}}
<script>
    base_Url = "{{url('/')}}"


   function regWithPaystack1(){

   var _token = $("input[name='_token']").val();

   var name = $("#name").val();
   var email = document.getElementById('email').value //$("#email").val();
   var password = $("#password").val();
   var refer = $("#refer").val();
   var role = $("#role").val();
   var agent_code = $("#agent_code").val();
    // console.log(new_id);
        console.log(email);




    var handler = PaystackPop.setup({
      key: 'pk_test_cb0fc910bb9fd127519794aa4128be0fd2c354d4',
      email: email,
      amount: 2000000,
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you

        metadata: {
         custom_fields: [
         {
          display_name: "Mobile Number",
          variable_name: "mobile_number",
          value: "+2348012345678"
        }
        ]
      },
      callback: function(response){
        var ref_no1 = response.reference;
    });*/
    $.ajax({
      type:'POST',
                      url: "{{ route('createpaypaystack2') }}",
                      // url: base_Url + '/provider/service/createpay/',
                      data: {_token:_token, email:email, password:password, refer:refer, role:role, agent_code:agent_code},
                      success: function(data) {
                        alert(data);
                        console.log(data);
                      }
                    });
         //   alert('success. transaction ref is ' + response.reference);
       },
       onClose: function(){
        alert('window closed');
      }
    });
    handler.openIframe();
  }
  </script>


@endsection
