
@extends('layouts.app')
@section('title', 'Registration success | ')

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
                        <h3>Registration Success</h3>
                       

                        <div class="clearfix"></div>

                          <form id="paymentForm">
                            @csrf
                                <div id="btn-container" class="form-group clearfix mb-0 text-center">
                                    {{-- btn for without pay --}}
                                    {{-- <button type="submit" class="btn-md float-left" style="background-color: #cc8a19; color: #fff">Create Account</button> --}}
                                    {{-- btn for pay --}}
                                    

                                    <p class="text text-success">Congratulations {{$logistic->company_name}}! Your registration is successful, you will be contacted by our customer care representative within 24hrs.</p>                                    
                                    
                                    

                                </div>

                             
                                
                            </form>

                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
