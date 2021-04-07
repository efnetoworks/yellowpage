<form wire:submit.prevent='validate_form'>
    {{-- End form for paystack pay --}}
    {{-- {{ csrf_field() }} --}}

    <div class="form-group form-box">
        <input type="text" class="input-text" name="name"  autofocus placeholder="Full Name" wire:model='name'>

        @error('name')
        <span class="helper-text text-danger" data-error="wrong" data-success="right">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group form-box">
        <input type="text" placeholder="Email Address" class="input-text"  wire:model='email'>
        @if ($errors->has('email'))
        <span class="helper-text" data-error="wrong" data-success="right">
            <strong class="text-danger">{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <div class="input-group mb-3">
            <input type="password" name="password" id="passwordField" class="form-control" placeholder="Password (min: 6 chars)" aria-label="Password" aria-describedby="Password" wire:model='password'>
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
<!-- 
    <div class="form-group form-box clearfix">
        <input class="input-text" placeholder="Confirm Password" type="password" wire:model='password_confirmation'>
    </div> -->
    <div>

        <h6>What do you want to do?</h6>


        <div class="col-lg-12">
            <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" wire:model='role'>
                    <option selected> Choose... </option>
                    <option value="seller"> Provide a service </option>
                    <option value="buyer"> I'm looking for a service </option>
                </select>
            </div>
            @error('role')
            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>
    <div>
    @if(!$referParam)
    <div class="form-group form-box">
    <h6 class="text-center">Where you referred by our agent?</h6>
        <input id="agent_code" type="text" placeholder="Enter Agent Code (Optional)" class="input-text" wire:model='agent_code'>
        @if ($errors->has('agent_code'))
        <span class="helper-text" data-error="wrong" data-success="right">
            <strong class="text-danger">{{ $errors->first('agent_code') }}</strong>
        </span>
        @endif
    </div>
    @endif
    </div>

     <div>
        <h6>Choose a plan</h6>
        <div class="col-lg-12">
            <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" wire:model='plan'>
                    <option selected> Choose... </option>
                    <!-- <option value=200> One Month (&#8358;200) </option> -->
                    <option value=1200> Six Months (&#8358;1200) </option>
                    <option value=2400> One Year (&#8358;2400) </option>
                </select>
            </div>
            @error('role')
            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div>
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

        <button id="paystack_btn_control1" type="submit" class="btn-md float-left" style="background-color: #cc8a19; color: #fff">Create Account</button>

        <small id="error_msg_paystack1" class="text-danger"></small>
    </div>
</form>


<script>
window.addEventListener('pay_with_paystack', event => {
    // alert('Name updated to: ' + event.detail.newName);
    let handler = PaystackPop.setup({
        key: event.detail.data.key, // Replace with your public key
        email: event.detail.data.email,
        amount: event.detail.data.amount,
        ref: ''+Math.floor((Math.random() * 1000000000) + 1),
        onClose: function(){
            alert('Window closed.');
        },
        callback: function(response){
            $('#spinner-container').removeClass("d-none");
            $('#spinner-container').addClass('d-block')
            $('#btn-container').addClass('d-none')
            Livewire.emit('verifyPaystackAmount', response)
        }
    });
    handler.openIframe();
})
</script>

<style>

    .spinner {
      width: 30px;
      height: 30px;
      border-top: 10px solid #ff0000;
      border-right: 10px solid transparent;
      animation: spinner 0.4s linear infinite;
      border-radius: 50%;
      margin: auto;
    }
    .head {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      margin-left: 10px;
      margin-top: 10px;
      background-color: #ff0000;
    }
    @keyframes spinner {
      to {
        transform: rotate(360deg);
      }
    }

    </style>
