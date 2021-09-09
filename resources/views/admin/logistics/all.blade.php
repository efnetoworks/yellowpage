@extends('layouts.admin')

@section('title')
All Dispatch Riders |
@endsection

@section('content')



<div class="content-wrapper" style="min-height: 518px;">

	<div class="container">
		@include('layouts.backend_partials.status')
	</div>

	<section class="content">

		<div class="row">
			<div class="col-xs-12">



				<div class="box" >
					<div class="box-header">
						<h3 class="box-title"> All Dispatch Riders Table</h3>
					</div>

					<!-- /.box-header -->
					<div class="box-body table-responsive">
						<table class="display table table-bordered data_table_main">
							<thead>
								<tr>
									<th> # </th>
									<th> Name </th>
									<th> Email </th>
									<th> Date </th>
									<th> Status</th>
									<th> Action</th>
								</tr>
</thead>
								<tbody>
								@foreach($riders as $key => $rider)
								<tr>
									<td><a href="javascript:void(0)"> {{ ++$key }} </a></td>
									<td> {{ $rider->first_name .' '. $rider->last_name }} </td>
									<td><span class="text-muted"> </i> {{ $rider->email }} </span> </td>
									<td> {{ $rider->created_at->format('d/m/Y') }} </span></td>
									<td>@if($rider->is_verified == 1)<span id="active_text" class="text text-success">Verified</span>@elseif($rider->is_verified == 0)<span id="active_text" class="text text-danger">Not verified</span>@endif </td>

									@if($rider->is_verified == 0)
									<td>
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#launchMobileAgentModal-{{$rider->id}}">Verify This Rider</span></button>
									</td>
									@else
									<td>
										<button type="button" class="btn btn-success">
											<span id="activate">This rider has been verified</span></button>
									</td>
									@endif



							</tr>

							<div id="launchMobileAgentModal-{{$rider->id}}" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header" style="background-color: #cc8a19; color: #fff">
                              <h5 class="modal-title text-white" style="text-transform: uppercase">Details </h5>
                              <button type="button" class="close" data-dismiss="modal" style="color: #fff">&times;</button>
                          </div>
                          <div class="modal-body">
                               {{-- <h3>Details.</h3> --}}
                               <div class="row">
                               	<div class="col-md-6">
                               		<h4 class="text text-warning">Personal Information</h4>

	                               <p><b>Full name:</b> {{ $rider->first_name .' '. $rider->last_name }}</p>
	                               <p><b>Company name:</b> {{ $rider->company_name }}</p>
	                               <p><b>Phone number:</b> {{ $rider->phone }}</p>
	                               <p><b>Email address:</b> {{ $rider->email }} </p>
	                               <p><b>Address:</b>{{ $rider->address ?? 'Not provided' }} </p>
	                               {{-- <p><b>State:</b>{{ $rider->state->name }} </p> --}}
                               {{-- <p><b>City:</b>{{ $rider->local_government->name }} </p> --}}
                               	</div>

                               	<div class="col-md-6">


		                               <h4 class="text text-warning">Identification </h4>

		                               <p><b>Means of Identification:</b> {{ $rider->identification_type }} </p>
		                               <p><b>ID Number:</b> {{ $rider->identification_id }} </p>
		                               <p><b>BVN:</b> {{ $rider->bvn }} </p>
		                               @if($rider->cac = 1)
		                               <p><b>CAC Document:</b><a href=" {{ route('logistic.download.doc', $rider->slug) }} " class="btn btn-warning">Download </a></p>
		                               @else
		                               <p><b>CAC Document:</b> Non provided</p>
		                            	@endif
		                            		<p><b>Type of bike:</b> {{ $rider->type_of_bike }}</p>
		                            		<p><b>Plate Number:</b> {{ $rider->plate_number }}</p>
                               	</div>


                               </div>





                            		<h4 class="text text-warning">Payment Details</h4>
                            		@if($rider->paid = 1)
                            		<p><span class="text text-success">Paid</span></p>
                            		<p><b>Amount: </b>{{ $rider->paid_amount }}</p>
                            		<p><b>Transaction ID: </b>{{ $rider->payment_id }}</p>
                            		@else
                            		<p><span class="text text-danger">Not paid</span></p>
                            		@endif
                                  <div class="form-group">
                                      <button type="submit" onclick="activateUser({{$rider->id}})" class="btn btn-md btn-success" style="border-radius:5px;box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);">Verify</button>
                                              <p class="text-success" style="font-size: 15px" id="successMessage">
                                     <div class="send-btn">
                                              </p>
                                          </div>
                                  </div>


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
    {{-- {{ $admins->links() }} --}}


				</div>
				<!-- /.box-body -->
			</div>


			<!-- /.content -->
		</div>



	</div>

</div>
</section>
</div>



{{--
<script type="text/javascript">
	$(document).ready( function () {
	    $('#data_table1').DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
		  "language": {
    "paginate": {
      "previous": "Previous page"
    }
  }
		});
	});
</script> --}}

<script>
        function activateUser22(id) {
    event.preventDefault();
    if (confirm("Are you sure you want to change this user's status?")) {
        $.ajax({
            url: '/activate_user/' + id,
            method: 'get',
            success: function(result){
              alert('successfull');
                window.location.assign(window.location.href);
            }
        });
// '/admin/delete/faqs/{id}'
    } else {
              alert('failed');
        console.log('Delete process cancelled');
    }
    }
    </script>



    <script type="text/javascript">
function activateUser(id) {
swal({
title: "Verify this rider?",
text: "Please be sure and then confirm!",
type: "warning",
showCancelButton: !0,
confirmButtonText: "Yes!",
cancelButtonText: "No, dont bother!",
cancelButtonColor: '#dc3545',
reverseButtons: !0
}).then(function (e) {
if (e.value === true) {
$.ajax({
  url: '/superadmin/active-dispatch-rider/' + id,
  method: 'get',
  success: function(results){
  	// alert(results);
  	// console.log(results);
  	if (results.success === true)  {
			swal("Done!", results.message, "success");
			// document.getElementById("activate").innerHTML = results.message;
			// document.getElementById("active_text").innerHTML = results.status_message;
			// if (results.message === 'Activate') {
			// 	document.getElementById("active_text").style.color='#dc3545';
			// } else {
			// 		document.getElementById("active_text").style.color='blue';
			// }
			window.location.reload();
			// window.location.assign(window.location.href);
			} else {
				swal("Error!", results.message, "error");
			}
            }
        });
} else {
e.dismiss;
}
}, function (dismiss) {
return false;
})
}
</script>

@endsection
