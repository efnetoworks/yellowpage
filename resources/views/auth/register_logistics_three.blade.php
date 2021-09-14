
@extends('layouts.app')
@section('title', 'Registration Step Three | ')

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

    .containers {
     height: 120px;
     position: relative;
     max-width: 320px;
     margin: auto;
}
 .containers .imageWrapper {
     border: 3px solid #cc8a19;
     width: 70%;
     padding-bottom: 70%;
     border-radius: 50%;
     overflow: hidden;
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
}
 .containers .imageWrapper img {
     height: 105%;
     width: initial;
     max-height: 100%;
     max-width: initial;
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
}
 .file-upload {
     position: relative;
     overflow: hidden;
     margin: 10px;
}
 .file-upload {
     position: relative;
     overflow: hidden;
     margin: 10px;
     width: 100%;
     max-width: 150px;
     text-align: center;
     color: #cc8a19;
     font-size: 1.2em;
     background: transparent;
     border: 2px solid #cc8a19;
     display: inline;
     -ms-transition: all 0.2s ease;
     -webkit-transition: all 0.2s ease;
     transition: all 0.2s ease;
}
 .file-upload:hover {
     background: #fff;
     -webkit-box-shadow: 0px 0px 10px 0px rgba(255, 255, 255, 0.75);
     -moz-box-shadow: 0px 0px 10px 0px rgba(255, 255, 255, 0.75);
     box-shadow: 0px 0px 10px 0px rgba(255, 255, 255, 0.75);
}
 .file-upload input.file-inputs {
     position: absolute;
     top: 0;
     right: 0;
     margin: 0;
     padding: 0;
     font-size: 20px;
     cursor: pointer;
     opacity: 0;
     filter: alpha(opacity=0);
     height: 100%;
}
 
</style>

    <div class="contact-section">
        <div class="container">
            <div class="row login-box">
                <div class="col-lg-12 align-self-center pad-0">
                    <div class="form-section clearfix">
                        <h3>Step Three: Means of Identification</h3>
                       

                        <div class="clearfix"></div>

                          <form action="{{ route('submit_application_step_3') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                {{-- End form for paystack pay --}}
                                {{-- {{ csrf_field() }} --}}
                                {{-- <div class="row">
                                  <div class="small-12 large-4 columns text-center">
                                    
                                    <div class="containers">
                                      
                                      <div class="imageWrapper">
                                        <img class="reg_image" src="/images/user-icon.png">
                                      </div>
                                    </div>
                                    
                                    <button class="file-upload">            
                                      <input type="file" name="profile_image" class="file-inputs @error('profile_image') is-invalid @enderror">Choose Image
                                    </button>
                                  </div>
                                </div>
                                @error('profile_image')
                                <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror --}}
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group form-box">
                                            <label>Means of Identification <span style="color: red;">*</span></label>
                                            <select class="form-control @error('identification_type') is-invalid @enderror" name="identification_type" autofocus value="{{ old('identification_type') }}">
                                                <option value="National ID">National ID</option>
                                                <option value="Voters Card">Voters Card</option>
                                                <option value="Drivers License">Drivers License</option>
                                                <option value="International Passport">International Passport</option>tion value="Nigeria">Nigeria</option>
                                            </select>

                                            @error('identification_type')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group form-box">
                                            <label>Identification Number <span style="color: red;">*</span></label>
                                            <input type="text" id="bank_name" class="form-control @error('identification_number') is-invalid @enderror" name="identification_number" value="{{ old('identification_number') }}" placeholder="Enter the id number">
                                            @error('identification_number')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group form-box">
                                            <label>Bank Verification Number <span style="color: red;">*</span></label>
                                            <input type="number" class="form-control @error('bvn') is-invalid @enderror" name="bvn" value="{{ old('bvn') }}" placeholder="Enter your bvn">
                                            @error('bvn')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group form-box">
                                            <label>Do you have a CAC document? </label>
                                            <select class="form-control" name="cac">
                                                {{-- <option default>Do you have CAC documents?</option> --}}
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            @error('cac')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group form-box">
                                            <label>Upload CAC Document </label>
                                            <input type="file" id="bank_name" class="form-control" name="cac_document">
                                            @error('cac_document')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group form-box">
                                            <label>What type of bike do you own? <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control @error('type_of_bike') is-invalid @enderror" name="type_of_bike" value="{{ old('type_of_bike') }}" placeholder=" kind of bike do you own?">
                                            @error('type_of_bike')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group form-box">
                                            <label>Plate Number <span style="color: red;">*</span></label>
                                            <input type="text" id="bank_name" class="form-control @error('plate_number') is-invalid @enderror" name="plate_number" value="{{ old('plate_number') }}" placeholder="Enter the plate number of your bike">
                                            @error('plate_number')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group form-box">
                                            <label>Upload Passport Photograph <span style="color: red;">*</span></label>
                                            <input type="file" id="bank_name" class="form-control" name="profile_image">
                                            @error('profile_image')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
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
                          
                                <div style="padding-top: 15px;">
                                    <label>
                                        <input type="checkbox" name="terms" class="filled-in" wire:model='terms'/>
                                        <span>By registering you accept our <a href="{{route('terms-of-use')}}" target="_blank" style="color: blue">Terms of Use</a> and <a href="{{route('privacy-policy')}}" target="_blank" style="color: blue"> Privacy</a> and agree that we and our selected partners may contact you with relevant offers and services.</span>
                                    </label>
                                    @error('terms')
                                    <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

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

                                    <button id="paystack_btn_control1" type="submit" class="btn-md float-right" style="background-color: #cc8a19; color: #fff">Next Step</button>
                                    <a href="{{ url()->previous() }}" id="paystack_btn_control1" type="submit" class="btn-md float-left" style="background-color: #fff; color: #cc8a19; border: 1px solid #cc8a19;">Previous</a>

                                    

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

<script>
    $('.file-inputs').change(function(){
    var curElement = $('.reg_image');
    console.log('element changed',curElement);
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        curElement.attr('src', e.target.result);
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});
</script>

@endsection
