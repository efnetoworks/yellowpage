
@extends('layouts.app')
@section('title', 'Login | ')

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
                <div class="form-section align-self-center">
                    <h3>Login into your logistics account</h3>
                    <div class="btn-section clearfix">
                        {{-- <a href="{{route('login')}}" class="link-btn btn-1 active-bg">Login</a>
                        <a href="{{route('register')}}" class="link-btn btn-2 default-bg">Register</a> --}}
                    </div>
                    <div class="clearfix"></div>

                    {{--
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                        @endif

                        --}}

                        <!-- @include('layouts.frontend_partials.status') -->
                        
                        @if (session('fail'))

                        <span class="helper-text" data-error="wrong" data-success="right">
                            <strong class="text-danger">{{ session('fail') }}</strong>
                        </span>
                        @endif
                        <form action="{{route('login_dashboard')}}" method="POST">
                            @csrf
                            <div class="form-group form-box">
                                <input type="email" name="email" value="{{ old('email') }}" class="input-text" placeholder="Email Address">
                            </div>
                            @if ($errors->has('email'))
                            <span class="helper-text" data-error="wrong" data-success="right">
                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="password" name="password" id="passwordField"
                                    class="form-control" placeholder="Password" aria-label="Password" aria-describedby="Password">
                                    <div class="input-group-append" id="showpasswordtoggle" name="showpasswordtoggle" onclick="showPassword()">
                                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-eye"></i></span>
                                  </div>
                              </div>
                              @if ($errors->has('password'))
                              <span class="helper-text" data-error="wrong" data-success="right">
                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <p class="text-left" style="margin-bottom: 20px">
                            <label>
                                <input type="checkbox" name="remember" class="filled-in" {{ old('remember') ? 'checked' : '' }} />
                                <span>{{ __('Remember Me') }}</span>
                            </label>
                        </p>
                        <div class="form-group clearfix mb-0">
                            <button type="submit" class="btn-md btn-warning float-left">Login</button>
                            <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password</a>
                        </div>
                        <div>
                            <small>Don't have an account? <span><a class="text-danger" href="{{ route('register_logistics') }}"> Click here </a> to register</span></small>
                        </div>
                    </form>
                </div>
            </div>
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
