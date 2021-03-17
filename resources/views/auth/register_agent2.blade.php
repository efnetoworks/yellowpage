
@extends('layouts.app')
@section('title', 'Register')

@section('content')
    <div class="contact-section">
        <div class="container">
            <div class="row login-box">
                <div class="col-lg-12 align-self-center pad-0">
                    <div class="form-section clearfix">
                        <h3>Complete Your Agent Account Here</h3>
                        <div class="btn-section clearfix">
                            {{-- <a href="{{route('login')}}" class="link-btn active btn-1 default-bg">Login</a> --}}
                            {{-- <a href="{{route('register')}}" class="link-btn btn-2 active-bg">Register</a> --}}
                        </div>

                        <div class="clearfix"></div>

                            <form method="POST" action="{{ route('agent_Complete_Reg') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Your Full Name</label><small class="text-danger">*</small>
                                            <input type="text" class="form-control" readonly name="name" value="{{ $agent_name }}" autofocus placeholder="Full Name" required>

                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" readonly class="form-control"  name="email" value="{{ $agent_email }}">

                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                         <div class="form-group">
                                            <label class="form-label">Phone Number</label><small class="text-danger">*</small>
                                            <input type="phone" placeholder="Phone Number" class="form-control" name="phone" value="{{ old('phone') }}"
                                            >
                                            @if ($errors->has('phone'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                        <div class="col-md-6">

                                      <div class="form-group">
                                            <label class="form-label">Select your State</label><small class="text-danger">*</small>
                                            <select class="form-control"  id="state" name="state" >
                                                <option value="">-- Select State --</option>
                                                @if(isset($states))
                                                    @foreach($states as $state)
                                                        <option value="{{$state->name}}"> {{ $state->name }}  </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                           <label class="form-label">Choose Password</label><small class="text-danger">*</small>
                                           <input type="password" class="form-control" name="password" placeholder="Password (min: 6 characters)" >
                                           @if ($errors->has('password'))
                                           <span class="helper-text" data-error="wrong" data-success="right">
                                               <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                           </span>
                                           @endif
                                       </div>
                                           </div>
                                       <div class="col-md-6">

                                       <div class="form-group">
                                           <label class="form-label">Confirm Password</label><small class="text-danger">*</small>
                                           <input class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation" >
                                       </div>
                                   </div>
                                    {{-- <div class="col-md-6">
                                       <div class="form-group">
                                            <label class="form-label">LGA</label><small class="text-danger">*</small>
                                            <select class="form-control" id="lgas" name="lga" required>
                                                <option disabled selected>- Select Local Government -</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                    <label class="form-label" for="identification_type">Identification Type</label><small class="text-danger">*</small>
                                                    <select class="form-control" name="identification_type" >
                                                        <option selected disabled>- Select an option -</option>
                                                        <option value="national_id">National ID</option>
                                                        <option value="driver_license">Driver License</option>
                                                        <option value="voter_id">Voter's Card</option>
                                                        <option value="international_passport">International Passport</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                               <div class="form-group">
                                                    <label class="form-label">ID Number</label><small class="text-danger">*</small>
                                                    <input type="text" class="form-control" name="identification_id" value="{{ old('identification_id') }}" placeholder="ID Number" >
                                                </div>
                                            </div>


                                  <div class="col-md-12">
                                        <label>
                                            <input type="checkbox" name="terms" class="filled-in" />
                                            <span>By registering you accept our <a href="{{route('terms-of-use')}}" target="_blank" style="color: blue">Terms of Use</a> and <a href="{{route('privacy-policy')}}" target="_blank" style="color: blue"> Privacy</a> and agree that we and our selected partners may contact you with relevant offers and services.</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-lg btn-warning text-white">Register</button>
                                    </div>
                                   {{-- <div class="col-md-12">
                                       <small class="text-danger">Did Not Recieve Link, <a href="">CLICK HERE</a> To Resend</small>
                                   </div> --}}

                                </div>
                            </form>
                    </div>
                </div>

                {{-- <div class="col-lg-6 bg-color-15 align-self-center pad-0 p-3">
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
        var passField = document.getElementById("password");
        if (passField.type === "password") {
            passField.type = "text";
        } else {
            passField.type = "password";
        }
    }
</script>


@endsection