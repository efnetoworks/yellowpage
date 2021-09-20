
	<div class="box">

		<div class="box-header with-border">
			<h3 class="box-title"> Incoming Requests</h3>

			@if (url()->current() == route('admin.service.active') )
			<div class="box-tools">
				<form class="" method="GET" action="{{ route('admin.service.search') }}">
					<div class="input-group input-group-sm" style="width: 150px;">
						<input type="search" class="form-control pull-right" placeholder="Search" name="query"  value="{{ isset($query) ? $query : '' }}" required>

						<div class="input-group-btn">
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>
			@endif

		</div>
		<!-- /.box-header -->
		<div class="box-body ">
			<div class="table-responsive">
                <table class="table table-hover data_table_main">
                    <thead>
                        <tr>
                           <th> S/N </th>
                            <!-- <th> Referee Name </th> -->
                           
                            <th> Service Provider </th>
                            <th> Package </th>
                            <th> Tracking ID </th>
                            <th> Status </th>
                            <th> Time Requested </th>
                            <th> Action </th>

                                            <!-- <th> Status </th>
                                                <th> Action </th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($incoming_requests as $key => $request)
                            <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $request->user->name }}</td>
                            <td><a href="{{ route('serviceDetail', $request->service->slug) }}" style="color: #ca8309">{{ $request->service->name }}</a></td>
                            <td>{{ $request->tracking_id }}</td>
                            <td>Incoming request</td>
                            <td>{{ $request->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="#" class="btn btn-warning float-ship-btn" data-toggle="modal" data-target="#launchMobileAgentModal-{{$request->id}}">
                                {{-- <i class="fa fa-taxi"></i> --}}
                                Billing details
                                {{-- <i class="fa fa-plus my-float"></i> --}}
                                </a>
                            </td>
                        </tr>

                        <div id="launchMobileAgentModal-{{$request->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #cc8a19; color: #fff">
                                        <h5 class="modal-title text-white" style="text-transform: uppercase">Request from {{ $request->user->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" style="color: #fff">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <h3>Service provider details.</h3>
                                        <hr>
                                         <p><b>Name:</b> {{ $request->user->name }}</p>
                                         <p><b>Phone:</b> {{ $request->user->phone }}</p>
                                         <p><b>Email:</b> {{ $request->user->email }}</p>
                                         {{-- <p><b>Delivery address:</b> {{ $request->customer_address }}</p> --}}

                                         <div class="align-self-center">
                                             <i class="fa fa-angle-double-down" style="font-size: 50px; padding-left: 50px;"></i>
                                         </div>
                                         <h3>Reciever's Detail.</h3>
                                         <hr>
                                         <p><b>Name:</b> {{ $request->customer_name }}</p>
                                         <p><b>Phone number:</b> {{ $request->customer_phone }}</p>
                                         <p><b>Email address:</b> {{ $request->customer_email }}</p>
                                         <p><b>State:</b> {{ $request->state->name }}</p>
                                         <p><b>City:</b> {{ $request->city }}</p>
                                         <p><b>Address:</b> {{ $request->customer_address }}</p>
                                         <form id="" action="{{ route('logistic.transit.mode', $request->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-md btn-warning" style="border-radius:5px;box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);"><i class="fa fa-truck my-float"></i> Deliver this product now</button>
                                                        <p class="text-success" style="font-size: 15px" id="successMessage">
                                               <div class="send-btn">
                                                        </p>
                                                    </div>
                                            </div>

                                           
                                        </form>
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
</div>
