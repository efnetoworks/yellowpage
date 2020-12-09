<div class="recently-properties content-area-12">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1> Featured Services </h1>
        </div>

<div class="container">
    @if(isset($user111))
        <p> The Search results for your query <b> query</b> are :</p>
    <h2>Sample User details</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user111 as $user)
            <tr>
                <td>{{$user->name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>



 @if(isset($seller))
        <p> The Search results for your query <b> query</b> are :</p>
    <h2>Sample User details</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Seller</th>
                <th>Service</th>
                <th>Phone</th>
                <th>More</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seller as $user)
            <a href="{{route('serviceDetail', $user->id)}}"><tr>
                <td>{{$user->user->name}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->user->phone}}</td>
                <td>
                    <a href="{{route('serviceDetail', $user->id)}}">view</a>
                </td>
                

            </tr>
            @endforeach
        </tbody>
    </table>
    @endif


 @if(isset($featuredServices))

<div class="row">
    @foreach($featuredServices as $featuredService)

<div class="col-lg-4 col-md-6 col-sm-12 filtr-item" data-category="3, 2, 1" style="">
                    <div class="property-box">
                        <div class="property-thumbnail">
                            <a href="{{route('serviceDetail', $featuredService->id)}}" class="property-img">
                                <div class="listing-badges">
                                    <span class="featured bg-warning">featured</span>
                                </div>
                                <div class="price-ratings-box">
                                    <p class="price">
                                        {{$featuredService->experience}} Yrs Experience
                                    </p>
                                   <!-- <div class="ratings">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div> -->
                                </div>
                                <div class="listing-time opening">{{$featuredService->user->name}}</div>
                                <img class="d-block w-100" src="{{asset('images')}}/{{$featuredService->image}}" style="width: 100%; height: 15vw; object-fit: cover;" alt="properties">
                            </a>
                        </div>
                        <div class="detail">
                            <span><a class="title " href="properties-details.html">{{$featuredService->name}}</a>
                            <a class="pull-right" href="properties-details.html">
                                    <i class="fa fa-map-marker"></i>&nbsp; &nbsp;{{$featuredService->city}}&nbsp;, {{$featuredService->state}}
                                </a></span>
                           
                            <ul class="facilities-list clearfix">
                                <li>
                                    <i class="flaticon-square block"></i>&nbsp; &nbsp; 5 likes
                                </li>
                                <li class="" style="float: right;">
                                    <i class="flaticon-time"></i>&nbsp; &nbsp;<a href="{{route('serviceDetail', $featuredService->id)}}">See Details</a>
                                </li>
                               <!-- <form action="{{ route('admin.like', $featuredService->id)}}" method="POST">
                            {{ csrf_field() }}

             <span id="alert-block"></span>                &nbsp;&nbsp;&nbsp; <input id="id" type="hidden" value="{{$featuredService->id}}" class="input-text" name="id"><button id="alert-block2" class="fa fa-thumbs-up btn-submit" type="submit">Like</button>
                        </form>-->
                                
                                <!--<li>
                                    <i class="flaticon-monitor"></i> TV
                                </li>-->
                            </ul>
                        </div>
                    <!--    <div class="footer clearfix">
                            <div class="pull-left days">
                                <a><i class="fa fa-user"></i>{{$featuredService->user->name}}</a>
                            </div>
                            <div class="pull-right">
                                <ul class="facilities-list clearfix">
                                <li>
                                   <i class="fa fa-thumbs-up"></i>Upvote
                                </li>
                                <li>
                                    <i class="fa fa-thumbs-down"></i>Downvote
                                </li>
                                 </ul>
                            </div>
                        </div>-->
                    </div>
                </div> 
                        @endforeach
       
    </div>









</div>


<div class="services-2 content-area-5 bg-grea-3">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1>What service are you looking for?</h1>
        </div>
 @if(isset($featuredServices))

    @foreach($featuredServices as $featuredService)


             <form action="{{ route('admin.like', $featuredService->id)}}" method="POST">
                            {{ csrf_field() }}

             <span id="alert-block"></span>   &nbsp;&nbsp;&nbsp; <input id="id" type="hidden" value="{{$featuredService->id}}" class="input-text" name="id"><button id="alert-block2" class="fa fa-thumbs-up btn-submit" type="submit">Like</button>
        <div class="row wow animated" style="visibility: visible;">
                @foreach($categories as $category)

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="service-info-5">
                    <i class="flaticon-apartment"></i>
                    <h4>{{$category->name}}</h4>
                    <p>Lorem ipsum dolor sit amet, consectur adipisicing elit, sed do eiusmod tempor incididunt</p>
                    <a href="{{ route('catdet', $category->id)}}">See Products</a>
                </div>
            </div>
            </form>
                                    @endforeach
                                    @endforeach
                                    @endif

            
        </div>
        <div class="text-center read-more-2">
            <a href="services-1.html" class="btn-white">Read More</a>
        </div>
    </div>
</div>

</div> 
@endif
<script type="text/javascript">
        $(document).ready(function() {
            $(".btn-submit").click(function(e){
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                var id = $("#id").val();

                $.ajax({
                    url: "{{ route('admin.like') }}",
                    type:'POST',
                    data: {_token:_token, id:id},
                    success: function(data) {
                      printMsg(data);
                    }
                });
            }); 

            function printMsg (msg) {
              if($.isEmptyObject(msg.error)){
                  console.log(msg.success);
                  $('#alert-block').empty().append(msg.success);
                  $('#alert-block2').empty().append(msg.success2);

                  //$('.alert-block').empty().('display','block').append('<strong>'+msg.success+'</strong>');
              }else{
                $.each( msg.error, function( key, value ) {
                  $('.'+key+'_err').text(value);
                });
              }

            }
        });
    </script>