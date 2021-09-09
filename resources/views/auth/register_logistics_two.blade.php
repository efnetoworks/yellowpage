
@extends('layouts.app')
@section('title', 'Registration Step Two | ')

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
                        <h3>Step Two: Address</h3>
                       

                        <div class="clearfix"></div>

                          <form action="{{ route('submit_application_step_2') }}" method="POST">
                            @csrf
                                {{-- End form for paystack pay --}}
                                {{-- {{ csrf_field() }} --}}
                                
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group form-box">
                                            <label>Country <span style="color: red;">*</span></label>
                                            <select class="form-control @error('country') is-invalid @enderror" name="country" autofocus value="{{ old('country') }}">
                                                <option value="Nigeria">Nigeria</option>
                                            </select>

                                            @error('country')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group form-box">
                                            <label>State <span style="color: red;">*</span></label>
                                            <select class="form-control @error('state') is-invalid @enderror" name="state" autofocus value="{{ old('state') }}" id="state_register">
                                                <option value="">-Select state-</option>
                                                @foreach($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('state')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group form-box">
                                            <label>City <span style="color: red;">*</span></label>
                                            <select class="form-control @error('lga') is-invalid @enderror" name="lga" id="city_register" autofocus value="{{ old('lga') }}">
                                                <option value="Nigeria">- Select city-</option>
                                            </select>
                                            @error('lga')
                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="form-group form-box">
                                    <label>Address <span style="color: red;">*</span></label>
                                    <input type="text" id="address" class="form-control" name="address"  autofocus placeholder="Address" value="{{ old('address') }}">

                                    @error('address')
                                    <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                    <a href="{{ url()->previous() }}" id="paystack_btn_control1" type="button" class="btn-md float-left" style="background-color: #fff; color: #cc8a19; border: 1px solid #cc8a19;">Previous</a>

                                    

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


  
  <script src="{{ asset('js/jquery-2.2.0.min.js') }}"></script>
  <script>
    $('#state_register').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:"GET",
                url: '../../get-city-list-by-id/'+stateID,
                success:function(res){
                    if(res){
                        $("#city_register").empty();
                        $.each(res,function(key,value){
                            $("#city_register").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#city_register").empty();
                    }
                }
            });
        }else{
            $("#city_register").empty();
        }

    });
  </script>

@endsection
