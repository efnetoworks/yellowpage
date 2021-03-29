
@extends('layouts.app')

@section('title', 'Advertise with us | ')

@section('content')
<style>
    .adp_img{
        width: 100% !important;
    }
    .send-btn button{
        background-color: #cc8a19; color: #fff; border:1px solid #cc8a19;
    }
    .send-btn button:hover{
        background-color: #eeb450; color: #fff; border:1px solid #cc8a19;
    }
    .form-group label{
        text-align: left !important;
        font-weight: 600 !important;
    }
</style>

    <div class="main">
        <div class="sub-banner" style="background-image:url({{asset('OurBackend/img/makeupartist.jfif')}})">
            <div class="container">
                <div class="page-name">
                    <div class="sub-banner-text-content">
                        <h1>Advertisement</h1>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><span>/</span>Advertise with us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="pricing-tables-3 content-area advertise-with-us-page">
            <div class="container" style="background-color: #fff; padding-top: 30px">
                <div class="text-center">
                    <p class="text-center">
                        Experience rapid boost in exposure of your business and services by placing Banner adverts on <br>
                        EFContact platform.
                    </p>
                    <h2>WHY EFContact?</h2>
                    <em><strong>"Your brand deserves the right audience"</strong></em>
                    <p>
                        With over half a million dedicated monthly visitors and 5-7 million monthly page-views,<br>
                        your business, product &amp; services are placed right in front of dedicated audience of<br>
                        EFContact platform.
                    </p>
                    <div>
                        <h2>BANNER AD SIZES</h2>
                        <a class="btn btn-warning btn-lg" style="color: #fff" href="{{ route('download.ad.brochure') }}">Download Banner Brochure</a>
                    </div>
                </div>

                <hr>
                <div class="row">
                    @if ($advert_locations)
                        @foreach($advert_locations as $advert_location)
                            <div class="col-xl-4 col-lg-4 col-md-12">
                                <div class="pricing-3 popular">
                                    <div class="title" style="font-weight: 600">{{ $advert_location->title }}</div>
                                    <div style="margin-top: 5px">
                                        @if ($advert_location->id == 1)
                                            <img src="{{ asset('topnav.jpg') }}" alt="{{ $advert_location->title }}" class="img-fluid adp_img" />
                                        @elseif ($advert_location->id == 2)
                                            <img src="{{ asset('bigslider.jpg') }}" alt="{{ $advert_location->title }}" class="img-fluid adp_img" />
                                        @elseif ($advert_location->id == 3)
                                            <img src="{{ asset('featuredad.jpg') }}" alt="{{ $advert_location->title }}" class="img-fluid adp_img" />
                                        @elseif ($advert_location->id == 4)
                                            <img src="{{ asset('footeradfreespace.png') }}" alt="{{ $advert_location->title }}" class="img-fluid adp_img" />
                                        @elseif ($advert_location->id == 5)
                                            <img src="{{ asset('featuredad.jpg') }}" alt="{{ $advert_location->title }}" class="img-fluid adp_img" />
                                        @elseif ($advert_location->id == 6)
                                            <img src="{{ asset('categoriesad.png') }}" alt="{{ $advert_location->title }}" class="img-fluid adp_img" style="height: 350px; width: auto !important; margin: 0 auto;" />
                                        @elseif ($advert_location->id == 7)
                                            <img src="{{ asset('newsletterad.png') }}" alt="{{ $advert_location->title }}" class="img-fluid adp_img" />
                                        @endif
                                    </div>
                                    <div class="content text-left" style="padding: 20px">

                                        <p>
                                            <strong>Location:</strong> {{ $advert_location->location }}<br>
                                            <strong>Dimensions:</strong> {{ $advert_location->size }} pixels
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No Advert Location Yet!</p>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="submit-address advertise-with-us-page-form">
                            <form method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="POST">

                                <div class="text-center">
                                    <h3 class="heading-2">Contact Us:</h3>
                                    <strong><a href="mailto:{{ $check_general_info == 0 ? $general_info->support_email : '' }} ">
                                        {{ $check_general_info == 0 ? $general_info->support_email : '' }}
                                    </a></strong>
                                    <a href="tel:{{ $check_general_info == 0 ? $general_info->hot_line : '' }} ">
                                        +234 {{ $check_general_info == 0 ? $general_info->hot_line : '' }}
                                    </a>,
                                    <a href="https://wa.me/{{ $check_general_info == 0 ? $general_info->hot_line_3 : '' }}/?text=Good%20day.%20I%20am%20interested%20in%20advertising%20my%20business%20and%20services." target="_blank">
                                        <i class="fa fa-whatsapp" style="font-size: 15px"></i> WhatsApp
                                    </a><br>
                                    <p><strong>Or fill the form below</strong></p>
                                </div>

                                <div class="search-contents-sidebar mb-30">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group name">
                                                        <label for="name">Full Name</label><small class="text-danger">*</small>
                                                        <input id="name" name="name" class="form-control"  required type="text" placeholder="Enter Full Name" style="color: black;">
                                                        @if ($errors->has('name'))
                                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group email">
                                                        <label for="email">Your Email</label><small class="text-danger">*</small>
                                                        <input id="email" name="email" class="form-control required email" required type="email" placeholder="Email" style="color: black;">
                                                        @if ($errors->has('email'))
                                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group subject">
                                                        <label for="subject">Subject</label><small class="text-danger">*</small>
                                                        <input type="text" name="subject" id="subject" required class="form-control" placeholder="Please enter your message subject" style="color: black;">
                                                        @if ($errors->has('subject'))
                                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                            <strong class="text-danger">{{ $errors->first('subject') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group number">
                                                        <label for="phone">Phone Number</label><small class="text-danger">*</small>
                                                        <input id="phone" name="phone" required class="form-control" type="number" placeholder="Enter your phone number" style="color: black;">
                                                        @if ($errors->has('phone'))
                                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                                <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12" style="" class="text-center">
                                                    <div class="form-group">
                                                        <label for="advert_type">Advertisement Type</label><small class="text-danger">*</small>
                                                        <select class="form-control text-center" id="advert_type" name="advert_type" required>
                                                            <option class="text-center" value="" selected disabled>-- Select Advert Type --</option>
                                                            @if ($advertlocations)
                                                                @foreach ($advertlocations as $advertlocation)
                                                                    <option class="text-center" value="{{ $advertlocation->title }}">{{ $advertlocation->title }}</option>
                                                                @endforeach

                                                            @else
                                                                <p>No location</p>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group message">
                                                        <label for="message">The Message</label><small class="text-danger">*</small>
                                                        <textarea class="form-control" required name="message" id="message" placeholder="Write message" style="color: black;"></textarea>
                                                        @if ($errors->has('message'))
                                                            <span class="helper-text text-danger" data-error="wrong" data-success="right">
                                                                <strong class="text-danger">{{ $errors->first('message') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="send-btn text-center">
                                                        <button type="submit" id="sendMessage" class="btn btn-lg">Send Message</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#sendMessage").click(function(e){
                e.preventDefault();

                $("#sendMessage").text('Please wait, sending!!!')
                $("#sendMessage").css({"opacity": "0.5", "cursor":"default"});

                var _token = $("input[name='_token']").val();
                var name = $("#name").val();
                var email = $("#email").val();
                var advert_type = $("#advert_type").val();
                var phone = $("#phone").val();
                var subject = $("#subject").val();
                var message = $("#message").val();

                $.ajax({
                    url: '/store_advert_request_form',
                    method:'POST',
                    data: {_token:_token, name, email, advert_type, phone, subject, message },
                    success: function(data) {
                        $("#name").val('')
                        $("#phone").val('')
                        $("#email").val('')
                        $("#advert_type").val('')
                        $("#subject").val('')
                        $("#message").val('')
                        $("#sendMessage").css({"opacity": "1", "cursor":"pointer"});
                        $("#sendMessage").text('Send another message')

                        toastr.success('Message sent successfully!')
                    },
                    error: function(error){
                        toastr.error('Message not sent! Try again. Make sure all fields are filled.')

                        $("#sendMessage").css({"opacity": "1", "cursor":"pointer"});
                        $("#sendMessage").text('Send message')
                    }
                });
            });
        })
    </script>
@endsection
