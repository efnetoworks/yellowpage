
	<div class="box">

		<div class="box-header with-border">
			<h3 class="box-title"> Delivered Requests</h3>

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
                            <th> Delivery date </th>
                            {{-- <th> Action </th> --}}

                                            <!-- <th> Status </th>
                                                <th> Action </th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($delivered_requests as $key => $request)
                            <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $request->user->name }}</td>
                            <td><a href="{{ route('serviceDetail', $request->service->slug) }}" target="_blank" style="color: #ca8309">{{ $request->service->name }}</a></td>
                            <td>{{ $request->tracking_id }}</td>
                            <td>Delivered</td>
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
                                        {{--  <form id="" action="{{ route('logistic.delivered.mode', $request->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-md btn-warning" style="border-radius:5px;box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);">I have delivered this product</button>
                                                        <p class="text-success" style="font-size: 15px" id="successMessage">
                                               <div class="send-btn">
                                                        </p>
                                                    </div>
                                            </div>

                                           
                                        </form> --}}
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
