

@extends('layouts.admin')

@section('title')
All Requests |
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
						<h3 class="box-title"> All Requests Table</h3>
					</div>

					<!-- /.box-header -->
					<div class="box-body table-responsive">
						<table class="display table table-bordered data_table_main">
							<thead>
								<tr>
									<th> # </th>
									<th> Service Provider </th>
                  <th> Package </th>
                  <th> Tracking ID </th>
                  <th> Status </th>
                  <th> Time Requested </th>
                  <th> Action </th>
								</tr>
</thead>
								<tbody>
								@foreach($requests as $key => $request)
								<tr>
									<td>{{ ++$key }}</td>
                  <td>{{ $request->user->name }}</td>
                  <td><a href="{{ route('serviceDetail', $request->service->slug) }}" style="color: #ca8309">{{ $request->service->name }}</a></td>
                  <td>{{ $request->tracking_id }}</td>
                  <td> 
                    @if($request->is_delivered == 1) 
                      <span class="text text-success">Delivered</span> 
                    @elseif($request->in_transit == 1 ) <span class="text text-warning">In Transit</span>

                    @else
                    <span class="text text-danger">Pending</span>
                    @endif
                  </td>
                  <td>{{ $request->created_at->diffForHumans() }}</td>
                  <td>
                      <a href="#" class="btn btn-warning float-ship-btn" data-toggle="modal" data-target="#launchMobileAgentModal-{{$request->id}}">
                      {{-- <i class="fa fa-taxi"></i> --}}
                      Billing details
                      {{-- <i class="fa fa-plus my-float"></i> --}}
                      </a>
                  </td>


									{{-- {{ $general_info->register_section_1_title ? $general_info->register_section_1_title : '' }} --}}

							</tr>

							<div id="launchMobileAgentModal-{{$request->id}}" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header" style="background-color: #cc8a19; color: #fff">
                              <h5 class="modal-title text-white" style="text-transform: uppercase">Details </h5>
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
                               <p><b>Address:</b> {{ $request->customer_address }}</p>
                               

                                 
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


