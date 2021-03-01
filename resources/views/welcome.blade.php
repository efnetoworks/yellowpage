@extends('layouts.app')
@section('title', 'The largest service place in the Nigeria | ')

@section('content')


@include('layouts.frontend_partials.status')

@include('frontend_section/carousel')

@include('frontend_section/search')

<a href="#" data-toggle="modal" data-target="#launchFeedback" class="float-feedback  animate__animated animate__fadeInRight">
    Feedback
</a>

<style>
    .float-feedback{
        position:fixed;
        width:100px;
        height:50px;
        top:90px;
        right:0;
        background-color:#03A84E;
        color:#FFF;
        text-align:center;
        font-weight: 400 !important;
        box-shadow: 2px 2px 3px #999;
        padding: 15px 10px;
        border-bottom-left-radius: 50px;
        border-top-left-radius: 50px;
        z-index: 99999;
        transition: background-color 1s;
    }
    .float-feedback:hover{
        background-color:#0e8543;
        color: rgb(230, 227, 227);
    }
    .my-float{
        margin-top:22px;
    }

    @media (max-width: 768px){
        .float-feedback{
            width:80px;
            height:30px;
            font-size: 12px;
            padding: 7px 10px;
            top:60px;
        }
    }
</style>

    <!-- Modal -->
    <div id="launchFeedback" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thank You For Your Feedback!</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="feedbackForm" action="{{ route('feedback.form') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea name="userfeedback" id="userfeedback" class="form-control" cols="30" rows="5" placeholder="Enter your feedback here..." style="border-radius: 0"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="submitFeedback()" class="btn btn-info" data-dismiss="modal">Send</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

<script>
    function submitFeedback() {
        $.ajax({
            url: '/user-feedback',
            type: 'post',
            dataType: 'json',
            data: $('form#feedbackForm').serialize(),
            success: function(data) {
                console.log(data)
                alert('Feedback sent! Thank You.')
            }
        });
    }
</script>


<script>
var x = document.getElementById("demo2");
var y = document.getElementById("latitude_id");
var z = document.getElementById("longitude_id");



function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
   var res = "Geolocation is not supported by this browser.";
  }
}


function showPosition(position) {

    console.log('latitude', position.coords.latitude);

        var lat = document.getElementById("latitude_id").value = position.coords.latitude;
    console.log('lat', lat);
     var long = document.getElementById("longitude_id").value = position.coords.longitude;
    console.log('long', long);

   $.ajax({
            type:'GET',
            url: 'findgeo',
            data: {latitude:position.coords.latitude, longitude:position.coords.longitude },
           success: function(result){
                    services = result.data;
                        services.forEach(service => {
                            badge = service.badge_type
                            if (badge == 1) {
                              badge = '<span class="featured bg-warning" style="text-transform: uppercase; font-size: 13px;"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> Super</span>';
                            }
                            if (badge == 2) {
                              badge = '<span class="featured bg-success" style="text-transform: uppercase; font-size: 13px;"><i class="fa fa-star"></i><i class="fa fa-star"></i> Moderate</span>';
                            }
                            if (badge == 3) {
                              badge = '<span class="featured bg-primary" style="text-transform: uppercase; font-size: 13px;"><i class="fa fa-star"></i> Basic</span>';
                            }
                            if (badge == 4) {
                              badge = '';
                            }
                            // if (service.badge_type == 'trusted') {
                            //   service.badge_type == 'truuuue';
                            // }
                            $('#servicesCloseToYouRow').append(`<a href="/serviceDetail/`+ service.slug + `" class="property-img">
                                <div class="col-lg-2 col-md-4 col-sm-6 filtr-item" data-category="3, 2, 1" style="">
                                    <div class="property-box">
                                        <div class="property-thumbnail">
                                            <div class="listing-badges">`+
                                                badge
                                            +`</div>
                                            <div class="price-ratings-box">
                                                <p class="price" style="text-transform: capitalize">
                                                    `+ service.user.name.substring(0, 10) + "..." + `
                                                </p>
                                            </div>
                                            <img class="d-block w-100 service_images" src="/uploads/services/`+ service.thumbnail + `" alt="properties">

                                        </div>
                                        <div class="detail">
                                            <div>
                                                <a class="title title-dk" href="">`+ service.name.substring(0, 18) + "..." + `</a>
                                                <a class="title title-mb" href="">`+ service.name.substring(0, 10) + "..." + `</a>
                                            </div>

                                            <ul class="d-flex flex-row justify-content-between info">
                                                <li>
                                                    <i class="fa fa-map-marker text-warning"></i> `+ service.state.substring(0, 5) + `
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </a>`
)

                        });
                }



            });
}
</script>




<script type="text/javascript">
        $(document).ready(function() {
        document.getElementById("complaint_notification").hidden = true;
        $(".btn-submit3").click(function(e){
        e.preventDefault();

        var _token = $("input[name='_token']").val();
        var buyer_id = $("#buyer_id_report").val();
        var buyer_name = $("#buyer_name_report").val();
        var service_id = $("#service_id_report").val();
        var service_user_id = $("#service_user_id_report").val();
        var buyer_email = $("#buyer_email_report").val();
        var description = $("#description_report").val();
        function greet(){
                    document.getElementById("complaint_notification").hidden = true;
                    document.getElementById("complaint_notification").innerHTML = "";
                }
         function set(){
              setTimeout(greet, 20000);
         }


        $.ajax({
            type:'POST',
            url: '/buyer/createcomplaint',
            data: {_token:_token, buyer_id:buyer_id, buyer_name:buyer_name, buyer_email:buyer_email, service_id:service_id, service_user_id:service_user_id,  description:description },
            success: function(data) {
                  document.getElementById("complaint_notification").hidden = false;
                    document.getElementById("complaint_notification").innerHTML = "Your complaint was sent successfully";
            //   greet();
            set();

                }
            });
        });

    });
</script>

@include('frontend_section/category')

<div class="blog content-area bg-grea-3 hm-feat-ser-mid-sec">
    <div class="service-detail-container">
            <!-- Main title -->
        <div class="main-title" style="margin-top: -50px;">
            <h1>Services Close To You </h1>
        </div>
        <div class="row" id="servicesCloseToYouRow"></div>
    </div>
</div>

@include('frontend_section/feature')

@include('frontend_section/recent')

@include('frontend_section/popular')

{{-- @include('frontend_section/brands') --}}

{{--<div class="partners">
    <div class="container">
        <h4>Brands and Partners</h4>
        <div class="slick-slider-area">
            <div class="row slick-carousel slick-initialized slick-slider" data-slick="{&quot;slidesToShow&quot;: 5, &quot;responsive&quot;:[{&quot;breakpoint&quot;: 1024,&quot;settings&quot;:{&quot;slidesToShow&quot;: 3}}, {&quot;breakpoint&quot;: 768,&quot;settings&quot;:{&quot;slidesToShow&quot;: 2}}]}"><div class="slick-list draggable" style="padding: 0px;"><div class="slick-track" style="opacity: 1; width: 3456px; transform: translate3d(-960px, 0px, 0px);"><div class="slick-slide slick-cloned" data-slick-index="-6" aria-hidden="true" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-1.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-cloned" data-slick-index="-5" aria-hidden="true" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-2.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-3.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-4.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-5.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-cloned slick-active" data-slick-index="-1" aria-hidden="false" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-6.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-active" data-slick-index="0" aria-hidden="false" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-1.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-current slick-active slick-center" data-slick-index="1" aria-hidden="false" style="width: 192px;"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-2.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-active" data-slick-index="2" aria-hidden="false" style="width: 192px;"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-3.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-active" data-slick-index="3" aria-hidden="false" style="width: 192px;"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-4.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide" data-slick-index="4" aria-hidden="true" style="width: 192px;"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-5.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide" data-slick-index="5" aria-hidden="true" style="width: 192px;"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-6.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-cloned" data-slick-index="6" aria-hidden="true" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-1.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-cloned" data-slick-index="7" aria-hidden="true" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-2.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-cloned" data-slick-index="8" aria-hidden="true" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-3.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-cloned" data-slick-index="9" aria-hidden="true" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-4.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-cloned" data-slick-index="10" aria-hidden="true" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-5.png" alt="brand" class="img-fluid"></div></div></div><div class="slick-slide slick-cloned" data-slick-index="11" aria-hidden="true" style="width: 192px;" tabindex="-1"><div><div class="slick-slide-item" style="width: 100%; display: inline-block;"><img src="/storage/clients/brand-6.png" alt="brand" class="img-fluid"></div></div></div></div></div></div>
            <div class="slick-prev slick-arrow-buton">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="slick-next slick-arrow-buton">
                <i class="fa fa-angle-right"></i>
            </div>
        </div>
    </div>
</div>--}}



<link href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css" rel="stylesheet">
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js">
</script>
 <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js">
   </script>

<!----------HTML code starts here------->
{{--<div class="container">
<div class="owl-carousel owl-theme owl-loaded owl-drag">

       <div class="owl-stage-outer">

         <div class="owl-stage" style="transform: translate3d(-1527px, 0px, 0px); transition: all 0.25s ease 0s; width: 3334px;">

           <div class="owl-item cloned" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>1</h4>
            </div>
         </div>

         <div class="owl-item cloned" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>2</h4>
            </div></div>

           <div class="owl-item cloned" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>3</h4>
            </div></div>

           <div class="owl-item cloned" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>4</h4>
            </div></div>

           <div class="owl-item cloned" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>5</h4>
            </div></div>

           <div class="owl-item cloned" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>6</h4>
            </div></div>

           <div class="owl-item" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>7</h4>
            </div></div><div class="owl-item" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>8</h4>
            </div></div>

           <div class="owl-item" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>9</h4>
            </div></div>

           <div class="owl-item" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>10</h4>
            </div></div><div class="owl-item" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>11</h4>
            </div></div>

           <div class="owl-item active" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>12</h4>
            </div></div>

           <div class="owl-item active" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>13</h4>
            </div></div>

           <div class="owl-item active" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>14</h4>
            </div></div>

           <div class="owl-item active" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>15</h4>
            </div></div>

           <div class="owl-item" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>16</h4>
            </div></div>

           <div class="owl-item" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>17</h4>
            </div>
            </div>
            <div class="owl-item" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>18</h4>
            </div></div>

           <div class="owl-item cloned" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>19</h4>
            </div></div>

           <div class="owl-item cloned" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>20</h4>
            </div></div>

           <div class="owl-item cloned" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>21</h4>
            </div></div>

           <div class="owl-item cloned" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>22</h4>
            </div></div>

           <div class="owl-item cloned" style="width: 128.906px; margin-right: 10px;"><div class="item">
              <h4>23</h4>
            </div></div>

           <div class="owl-item cloned" style=""><div class="item">
              <h4>24</h4>
            </div></div></div></div><div class="owl-nav disabled">

  </div>

</div>
</div>--}}


<style type="text/css">
	.owl-item {width: 128.906px; margin-right: 10px; background:powderblue; }
</style>

<script type="text/javascript">
	var owl = $('.owl-carousel');
owl.owlCarousel({
    items:4,
  // items change number for slider display on desktop

    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true
});
</script>



<script type="text/javascript">
  $(document).ready( function () {
  getLocation();
});
</script>



@endsection
