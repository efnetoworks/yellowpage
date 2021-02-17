
@extends('layouts.seller')

@section('title')
Create Service | 
@endsection

@section('content')

<br>
<hr>



<div class="content-wrapper" style="min-height: 868px;">

  @include('layouts.backend_partials.status')




  {{-- @if (session('service_id')) --}}
  <div id="drag_image" class="mb-5 container" style="display: none;">

    <div class="text-center" style="margin: 20px 0px 20px 0px;">
     {{--  <a href="https://shouts.dev/" target="_blank"><img src="https://i.imgur.com/hHZjfUq.png"></a><br> --}}
     <span class="text-danger">Click Inside To Drap and Drop Multiple Images For Your Service</span>
   </div>
   <div class="container">
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
       <form method="post" action="{{url('upload/store/')}}" enctype="multipart/form-data"
       class="dropzone" id="dropzone">
       @csrf
     </form>
   </div>
   <div class="col-lg-2">
     <a href="{{route('seller.service.all')}}"><button class="btn btn-danger">I'm Done</button></a>
   </div>
 </div>
</div>
</div>


{{-- @endif --}}


{{-- @if (!session('service_id')) --}}



<section class="content">
  <div class="row">
    <div class="col-xs-12">

     <div id="show_form" class="row clearfix">

      <form action="{{route('service.save')}}" method="POST" class="" enctype="multipart/form-data" style="display: block;">
        {{ csrf_field() }}

        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-plus"></i>

              <h2 class="box-title"><strong>Create A Service</strong></h2>
              <small class="text-danger">*please fill all astericked fields</small>
            </div>
            <div class="body">

              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">Service Name </label><small class="text-danger">*</small>
                  <input id='name' type="text" required name="name" value="{{ old('name') }}" class="form-control" value="">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Description</label>
                  <textarea id='description' name="description" value="{{ old('description') }}" class="form-control"></textarea>
                </div>
              </div>


              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label"> Experience (in years)</label><small class="text-danger">*</small>
                  <input id='experience' type="number"  value="{{ old('experience') }}" name="experience" placeholder="Insert a number" class="form-control" value="">
                </div>
              </div>


              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Phone</label><small class="text-danger">*</small>
                  <input id="phone" required type="number"  class="form-control" value="{{ old('phone') }}" placeholder="numbers only" name="phone" value=" {{ Auth::user()->phone }}">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">Min Price</label>
                  <input id="min_price" type="text" value="{{ old('min_price') }}" placeholder="e.g 2000 per hour" name="min_price" class="form-control">

                </div>
              </div>

              <div class="col-md-12">
                <div class="form-check">
                  <input id="negotiable" class="form-check-input" type="checkbox" value="{{ old('negotiable') }}" name="negotiable" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1">
                  Negotiable  </label>
                </div>
              </div>

              {{--<div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">Max Price</label>
                  <input type="number" placeholder="e.g 2000 per hour" name="max_price" class="form-control">

                </div>
              </div>--}}

              {{-- <div class="col-lg-2 col-md-3" style="">
                <div class="form-group">
                  <select class="form-control" value="{{ old('state') }}" id="state" name="state">
                    <option value="">-- Select State --</option>
                    @if(isset($states))

                    @foreach($states as $state)

                    <option value="{{$state->id}}"> {{ $state->name }}  </option> 
                    @endforeach
                    @endif


                  </select>
                </div>
              </div>--}}

              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">State</label><small class="text-danger">*</small>
                  {{--}} <input type="text"  class="form-control" name="state" autocomplete="" aria-autocomplete="" value="{{ old('state') }}">--}}


                  <select class="form-control" required id="state"  name="state">
                    <option value="">-- Select State --</option>
                    @if(isset($states))

                    @foreach($states as $state)

                    <option id="state" value="{{$state->name}}"> {{ $state->name }}  </option> 
                    @endforeach
                    @endif


                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">City</label><small class="text-danger">*</small>


                  <select class="form-control" id="city" name="city">



                  </select>
                  {{-- @if ($errors->has('city'))
                  <span class="helper-text text-danger" data-error="wrong" data-success="right">
                    <strong class="text-danger">{{ $errors->first('city') }}</strong>
                  </span>
                  @endif --}}

                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">Address</label><small class="text-danger">*</small>
                  <input required id="address" type="text"  value="{{ old('address') }}" class="form-control" name="address">
                </div>

              </div>

              <div class="form-group" style="visibility: hidden">
                <label for=""></label>
                <textarea name="nearby" class="form-control"></textarea>
              </div>

            </div>
          </div>


        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="box box-default">

           <div class="body">


            {{-- former image upload div --}}

            {{-- <div class="box-header with-border">

              <h6 class="box-title">Service Images</h6> &nbsp;
              <small class="text-danger">*</small>
            </div>
            --}}

            {{-- <div class="">

             <small class="text-success">Click to select multiple images!</small>
             <div class="body">
              <input class="form-control"  value="{{ old('file') }}" multiple  name="files[]" type="file">
              <span class="helper-text text-center" data-error="wrong" data-success="right">Upload Images</span>
              @if ($errors->has('files'))
              <span class="helper-text text-danger" data-error="wrong" data-success="right">
                <strong class="text-danger">{{ $errors->first('files') }}</strong>
              </span>
              @endif
            </div> --}}

            {{-- end former image upload div --}}


            <div class="form-group">
              <label>Select Category</label>
              <small class="text-danger">*</small>
              <select name="category_id" required class="form-control show-tick">
                <option value="">-- Please select --</option>
                @foreach($category as $categories)
                <option id="category_id" value=" {{ $categories->id }} "> {{ $categories->name }} </option>
                @endforeach
              </select>
            </div>

            <div class="">
              <div class="">
                <h3 class="box-title"> Service Video</h3>
              </div>
              <div class="body">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" class="form-control" name="video_link">
                    <label class="form-label">Video</label>
                  </div>
                  <div class="help-info">Youtube Link</div>
                </div>

              </div>
            </div>

            <div class="">
              <div class="">
                <h3 class="box-title"> <!--Featured Image</h3-->
                </div>
                <div class="body">

                  <a href=" {{ route('seller.service.all') }}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                    <i class="fa fa-arrow-left"></i>
                    <span>BACK</span>
                  </a>

                  <button id="save_btn"  class="btn btn-primary btn-submit_service btn-lg m-t-15 waves-effect">
                    <i class="fa fa-save"></i>

                    <span>Submit</span>
                  </button>

                 <!--  <button  class="buttonload">
                    <i class="fa fa-spinner fa-spin"></i>Loading
                  </button> -->

                </div>
               <!--  <div id="loading" style="display: block;" class="spinner-grow text-danger" role="status">
                  <span class="sr-only">Loading...</span>
                </div> -->
              </div>

            </div>
          </div>
        </div>
      </div></form>
      <div class="spinner-border m-5" role="status">
        <span class="sr-only">Loading...</span>
      </div>

    </div>
    <!-- /.row -->
  </div></div>

</section>

{{-- @endif --}}

</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script type="text/javascript">
 $('#state').on('change',function(){
  console.log('ddd');
  var stateID = $(this).val();   
  if(stateID){
    $.ajax({
     type:"GET",
           //url:"{{url('qqq')}}"+stateID,
           url: '../../api/get-city-list/'+stateID,
           success:function(res){               
            if(res){
             console.log(res);
             console.log(stateID);
             $("#city").empty();
             $.each(res,function(key,value){
              $("#city").append('<option value="'+value+'">'+value+'</option>');
            });

           }else{
             $("#city").empty();
           }
         }
       });
  }else{
    $("#city").empty();
  }

}); 

</script>



{{-- 
  <script type="text/javascript">
    $(document).ready(function() {
        // document.getElementById("complaint_notification").hidden = true;
        $(".btn-submit_service").click(function(e){
          document.getElementById("save_btn").style.display = 'none';
          $("#save_btn").addClass("disabled");
        // document.getElementById("loading").style.display = 'block';
        e.preventDefault();

        var _token = $("input[name='_token']").val();
        var name = $("#name").val();
        var description = $("#description").val();
        var experience = $("#experience").val();
        var phone = $("#phone").val();
        var min_price = $("#min_price").val();
        var state = $("#state").val();
        var city = $("#city").val();
        var address = $("#address").val();
        var category_id = $("#category_id").val();
        // function greet(){
        //             document.getElementById("complaint_notification").hidden = true;
        //             document.getElementById("complaint_notification").innerHTML = "";
        //         }
        //  function set(){
        //       setTimeout(greet, 20000);
        //  }


        $.ajax({
          type:'POST',
          url: '/service/store',
          data: {_token:_token, name:name,  description:description, experience:experience, phone:phone, min_price:min_price, state:state, city:city, address:address, category_id:category_id },
          success: function(data) {
            console.log(data);
            alert('qqq');
                  // document.getElementById("ww").hidden = false;
                  document.getElementById("drag_image").style.removeProperty('display');
                  document.getElementById("show_form").style.display = 'none';
                  document.getElementById("loading").style.removeProperty('display');
                  document.getElementById("loading_btn").style.display = 'block';


                        // document.getElementById("drag_image").style.removeProperty('display');

            //         document.getElementById("complaint_notification").innerHTML = "Your complaint was sent successfully";
            // //   greet();
            // set();

          }
        });
      });

      });
    </script>
    --}}

    <script type="text/javascript">
      $(document).ready(function() {
        var service_id
      });
    </script>


    <script type="text/javascript">
      Dropzone.options.dropzone =
      {
        maxFilesize: 12,
        renameFile: function (file) {
          var dt = new Date();
          var time = dt.getTime();
          return time + file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 50000,
        removedfile: function (file) {
          var name = file.upload.filename;
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: 'POST',
            url: '{{ url("delete") }}',
            data: {filename: name},
            success: function (data) {
              console.log("File has been successfully removed!!");
            },
            error: function (e) {
              console.log(e);
            }
          });
          var fileRef;
          return (fileRef = file.previewElement) != null ?
          fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },

        success: function (file, response) {
          console.log(response);
        },
        error: function (file, response) {
          return false;
        }
      };
    </script>

    {{-- 
      <p>Click the button to get your coordinates.</p>

      <button onclick="getLocation()">Try It</button>

      <p id="demo"></p>

      <script>
        var x = document.getElementById("demo");

        function getLocation() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
          } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
          }
        }

        function showPosition(position) {
          x.innerHTML = "Latitude: " + position.coords.latitude + 
          "<br>Longitude: " + position.coords.longitude;
        }

        function showError(error) {
          switch(error.code) {
            case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
            case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
            case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
            case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
          }
        }
      </script>

      <script type="text/javascript">
        $(document).ready( function () {
    // alert('ddsdsd');
    getLocation();
  });
</script>

--}}





















































































































{{--

  <form action="{{route('service.save')}}" method="post" name="file" files="true" enctype="multipart/form-data" class="dropzone" id="image-upload">
    @csrf
    <div>
      <h3 class="text-center">Upload Multiple Images</h3>
    </div>    
    <button type="submit"> Upload Img</button>
  </form>


  <script type="text/javascript">
    Dropzone.options.imageUpload = {
      maxFilesize: 5,
      acceptedFiles: ".jpeg,.jpg,.png,.gif,.svg"
    };
  </script>

  --}}




  @endsection