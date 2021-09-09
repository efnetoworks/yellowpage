@extends('layouts.logistic')

@section('title', 'History | ')

@section('content')

<div class="content-wrapper" style="min-height: 518px;">

    <div class="container">
        @include('layouts.backend_partials.status')
    </div>
    <section class="content-header">
        <p id="referer_text" style="font-size: 21px">You can view all your requests history here.</p>

    </section>
    <section class="content">

      <div class="row">
       <div class="col-xs-12">

        <div class="box" >
         <div class="box-header">
          <h5 class="text-success downline_text" style="display: none;"> Manage all your requests </h5>
      </div>
    

      <!-- /.box-header -->
      <div id="main_referer_table" class="box-body">
          <div class="table-responsive">
            <table class="display table table-bordered data_table_main">
                <thead>
                    <tr>
                       <th> S/N </th>
                        <!-- <th> Referee Name </th> -->
                       
                        <th> Service Provider </th>
                        <th> Package </th>
                        <th> Tracking ID </th>
                        <th> In-transit </th>
                        <th> Delivered </th>
                        <th> Request date </th>
                        {{-- <th> Action </th> --}}

                                        <!-- <th> Status </th>
                                            <th> Action </th> -->
                    </tr>
                </thead>

                <tbody>
                    @foreach($requests as $key=>$request)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $request->user->name }}</td>
                            <td><a href="{{ route('serviceDetail', $request->service->slug) }}" target="_blank" style="color: #ca8309">{{ $request->service->name }}</a></td>
                            <td>{{ $request->tracking_id }}</td>
                            <td>{{ ($request->in_transit) ? 'Yes' : 'No' }}</td>
                            <td>{{ ($request->is_delivered)  ? 'Yes' : 'No' }}</td>
                            <td>{{ $request->updated_at->diffForHumans() }}</td>

                            {{-- <td>
                                <a href="#" class="float-ship-btn" data-toggle="modal" data-target="#launchMobileAgentModal">
                                <i class="fa fa-taxi"></i>
                                Delivered
                                
                                </a>
                            </td> --}}
                        </tr>

                        <div id="launchMobileAgentModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #cc8a19; color: #fff">
                                        <h5 class="modal-title text-white" style="text-transform: uppercase">Request from to {{ $request->user->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" style="color: #fff">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        
                                         {{-- <h3>Details.</h3> --}}
                                         <p><b>Name of customer:</b> {{ $request->customer_name }}</p>
                                         <p><b>Phone number of customer:</b> {{ $request->customer_phone }}</p>
                                         <p><b>Email address of customer:</b> {{ $request->customer_email }}</p>
                                         <p><b>Delivery address:</b> {{ $request->customer_address }}</p>
                                         @if($request->is_delivered == 0 && $request->in_transit == 1)
                                         <form id="" action="{{ route('logistic.delivered.mode', $request->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-md btn-warning" style="border-radius:5px;box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);">I have delivered this product</button>
                                                        <p class="text-success" style="font-size: 15px" id="successMessage">
                                               <div class="send-btn">
                                                        </p>
                                                    </div>
                                            </div>

                                           
                                        </form>
                                        @endif
                                        @if($request->in_transit == 0 && $request->is_delivered == 0)
                                        <form id="" action="{{ route('logistic.transit.mode', $request->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-md btn-warning" style="border-radius:5px;box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);">I am delivering this product</button>
                                                        <p class="text-success" style="font-size: 15px" id="successMessage">
                                               <div class="send-btn">
                                                        </p>
                                                    </div>
                                            </div>

                                           
                                        </form>
                                        @endif
                                    </div>

                                    {{-- <div class="modal-footer">
                                        <button type="button" class="btn btn-md" data-dismiss="modal" style="background-color: #cc8a19; color: #fff">Close</button>
                                    </div> --}}
                            </div>

                            </div>
                        </div>

                    @endforeach
                                       

                </tbody>


            </table>
            </div>
        </div>
        <!-- /.box-body -->

             



        <!-- /.box-header -->
        <div id="downline_table" style="display: none;" class="box-body">
                    
            <div>
                <button class="btn btn-warning downline_text w-10" style="display: none;" onclick="goBack()">Go Back</button>
                        
            </div>


            </div>


                <!-- /.content -->
        </div>



        </div>

    </section>
    <script type="text/javascript">

       function getDetails(id) {

        $.ajax({
          method: "GET",
          url: '/agent/referer/downline/' + id,

          success: function (data) {
            console.log(data);
        // toastr.success('You have purchased a new subscription!');
        $('#downline_table').css("display", "block");
        $('.downline_text').css("display", "block");
        $('#main_referer_table').css("display", "none");
        $('#referer_text').css("display", "none");

                                // $("#sub_end2").innerHTML = data.new_date;
                                $("#name").html(data.success.name);
                                    console.log(data.success);
                                if (data.success.level1) {
                                    var level1_value = 200;
                                    $("#level1").html(200);
                                }else{
                                    var level1_value = 0;
                                }
                                if (data.success.level2) {
                                    var level2_value = 150;
                                    $("#level2").html(150);
                                }else{
                                    var level2_value = 0;
                                }
                                if (data.success.level3) {
                                    var level3_value = 100;
                                    $("#level3").html(100);
                                }else{
                                    var level3_value = 0;
                                }
                                if (data.success.level4) {
                                    var level4_value = 50;
                                    $("#level4").html(50);
                                }else{
                                    var level4_value = 0;
                                }


                                var total =  level1_value +  level2_value + level3_value + level4_value;
                                console.log(total);
                                $("#total").html(total);

                                 // $("#level2").html(data.success.level2);
                                 // $("#level3").html(data.success.level3);

                                    // if (data.success.level1) {
                                    //  data.success.level1 = 200;
                                    // }
                                    // if (data.success.level2) {
                                    //  data.success.level2 = 150;
                                    // }
                                    // if (data.success.level3) {
                                    // data.success.level3 = 100;
                                    // }

                                 // $('#sub_message').css("display", "block");
                             },
                             error: function(error) {
                              console.log(error)
                          }
                      })
    }
</script>
<script type="text/javascript">
    function goBack(){
    // $('#main_referer_table').css("display", "block");
    // $('#downline_table').css("display", "none");
    location.reload(true)

      // window.history.back();
  }
</script>

@endsection
