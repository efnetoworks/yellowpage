@extends('layouts.logistic')

@section('title', 'Logistics\'s Dashboard | ')

@section('content')
<style>
    .content-header{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }
    .navbar-top-post-btn a{
        font-size: 15px !important;
        color:#fff
    }
    .refererArea h4{
        text-transform: uppercase;
    }
    .refererArea h4 small{
        font-size: 13px;
    }
    .refererArea h4 small a{
        color: #10CFBD;
        text-transform: initial;
    }
    .refererArea h4 small a:hover{
        color: #95f3ea;
        cursor: pointer;
    }
    .modal-title{
        text-transform: uppercase;
    }
    .form-text{
        display: block
    }
    .tab-content{
        padding-top: 20px;
    }
    @media (max-width: 768px){
        .content-header{
            padding: 0 5px 10px 10px;
        }
        .refererArea h4{
            font-size: 14px;
        }
        .refererArea .btn{
            font-size: 11px;
        }
        .navbar-top-post-btn a{
            font-size: 11px !important;
            margin-top: 40px
        }
        span.info-box-icon.push-bottom.bg-warning {
            display: none !important;
        }
        .info-box-content{
            margin-left: 0;
        }
        .info-box-text, .info-box-number{
            font-size: 14px;
        }
        .progress-description .btn{
            font-size: 9px;
        }
    }
</style>

<div class="wrapper">


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">

           
        </section>

        <section class="content">

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 top-box-card">
                    <div class="info-box">
                            <div class="info-box-content align-self-center text-center">
                                @if(Auth::guard('logistic')->user()->paid == 0 || Auth::guard('logistic')->user()->paid == NULL)
                                <span>You are almost there, make payment to complete your profile.</span>
                                <br>
                                <br>
                                {{-- <button type="button" class="btn btn-warning" id="paymentBtn"> Pay ₦2,000</button> --}}
                                <input type="hidden" name="" id="paid_amount" value="2000">
                                 <form id="paymentForm">
                                    <button type="button" class="btn btn-warning" onclick="payWithPaystack()" id="paymentBtn"> Pay ₦2,000</button>
                                </form> 
                                @else
                                    <span class="text text-success">Your payment is complete.</span>
                                @endif
                            </div>
                            <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- /.col -->

                
                <!-- /.col -->
            </div>
        </section>



                </div>
            </div>

    </script>

<script src="{{ asset('js/jquery-2.2.0.min.js') }}"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>

<script>


// var paymentForm = document.getElementById('paymentForm');
// paymentForm.addEventListener('submit', payWithPaystack, false);



var email = "{{ Auth::guard('logistic')->user()->email }}"
var base_url = "{{ url('/') }}";


function payWithPaystack() {
    // e.preventDefault();
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
      console.log(response)
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        method: "POST",
        url: base_url + '/logistics/payment-confirmation/' + response.reference,

        success: function()
        {
            window.location = base_url + '/logistics/dashboard';
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

<script>

</script>

    @endsection
