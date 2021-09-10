
@extends('layouts.app')
@section('title', 'Payment | ')

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
                        <h3>Step Three: Payment</h3>
                       

                        <div class="clearfix"></div>

                          <form id="paymentForm">
                            @csrf
                                <div id="btn-container" class="form-group clearfix mb-0 text-center">
                                    {{-- btn for without pay --}}
                                    {{-- <button type="submit" class="btn-md float-left" style="background-color: #cc8a19; color: #fff">Create Account</button> --}}
                                    {{-- btn for pay --}}
                                    

                                    

                                    @if(Session::has('dispatch'))

                                    <input type="hidden" name="" id="register_email" value="{{session()->get('dispatch')->email}}">
                                   
                                    @endif
                                    
                                    
                                    <input type="hidden" name="" id="paid_amount" value="2000">
                                    <a href="{{ url()->previous() }}" id="" class="btn-md" style="background-color: #fff; color: #cc8a19; border: 1px solid #cc8a19;">Previous</a>
                                    <button type="button" onclick="payWithPaystack()" id="paymentBtn" class="btn-md" style="background-color: #cc8a19; color: #fff">Pay ₦2,000</button>

                                    

                                    <small id="error_msg_paystack1" class="text-danger"></small>
                                </div>

                                <div>
                                    <div>
                                        <small>Already have an account? <span><a class="text-danger" href="{{ route('logistics_login') }}"> Click here </a> to login</span></small>
                                    </div>

                                </div>

                                <br>
                                <div>
                                

                                </div>
                          
                                

                                
                            </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

<script src="https://js.paystack.co/v1/inline.js"></script>
  @if(Session::has('dispatch'))

  <script>

    

    var email = "{{ Session::get('dispatch')->email }}"
    var email1 = "veeqanto@gmail.com"
    var slug = "{{ Session::get('dispatch')->slug }}"
    var base_url = "{{ url('/') }}";

    function payWithPaystack() {
        // e.preventDefault();
    // document.getElementById('paymentBtn').addClassList('.disabled')
    $('#paymentBtn').addClass('disabled');
      var handler = PaystackPop.setup({
        key: 'pk_test_cb0fc910bb9fd127519794aa4128be0fd2c354d4', // Replace with your public key
        email: email,
        amount:200000, // the amount value is multiplied by 100 to convert to the lowest currency unit
        currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
        ref: 'TRX'+Math.floor((Math.random() * 1000000000) + 1), // Replace with a reference you generated
        metadata: {
            "custom_fields": [
                {
                    amount: document.getElementById('paid_amount').value
                }
            ]
        },
        callback: function(response) {
          // this happens after the payment is completed successfully
        $.ajax({
            data: {
                '_token': "{{ csrf_token() }}"
            },

            method: "POST",
            url: base_url + '/logistics/payment-confirmation/' + response.reference,

            success: function(result)
            {
                window.location = base_url + '/logistics/registration-success';
            }
          });
          var reference = response.reference;
          alert('Payment complete! Reference: ' + reference);
          
          // Make an AJAX call to your server with the reference to verify the transaction
        },
        onClose: function() {
          alert('Transaction was not completed, window closed.');
        },
      });
      handler.openIframe();
    }
           
    </script>
    @endif
@endsection
