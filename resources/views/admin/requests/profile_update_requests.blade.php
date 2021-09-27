

@extends('layouts.admin')

@section('title')
All Profile Update Requests |
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
						<h3 class="box-title"> All Profile Update Requests Table</h3>
					</div>

					<!-- /.box-header -->
					<div class="box-body table-responsive">
						<table class="display table table-bordered data_table_main">
							<thead>
								<tr>
									<th> # </th>
									<th> Name </th>
                  <th> Passport </th>
                  <th> Company Name </th>
                  <th> Phone </th>
                  <th> Email </th>
                  <th> Identification Type </th>
                  <th> Identification Number </th>
                  <th> CAC Document </th>
                  <th> Address </th>
                  <th> Type of bike </th>
                  <th> Plate Number </th>
                  <th> Status </th>
                  <th> Time Requested </th>
                  <th> Action </th>
								</tr>
              </thead>
								<tbody>
								@foreach($update_requests as $key => $request)
								<tr>
									<td>{{ ++$key }}</td>
                  <td>{{ $request->first_name ." ". $request->last_name }}</td>
                  <td><img src="{{ asset('uploads/users/'.$request->profile_image) }}" height="50" width="50"></td>
                  <td>{{ $request->company_name }}</td>
                  <td>{{ $request->phone }}</td>
                  <td>{{ $request->email }}</td>
                  <td>{{ $request->identification_type }}</td>
                  <td>{{ $request->identification_id }}</td>
                  <td>{{ ($request->cac == 1) ? 'Download' : 'No CAC' }}</td>
                  <td>{{ $request->address }}</td>
                  <td>{{ $request->type_of_bike }}</td>
                  <td>{{ $request->plate_number }}</td>
                  <td> 
                    @if($request->approval_status == 1) 
                      <span class="text text-success">Approved</span> 
                    

                    @else
                    <span class="text text-danger">Pending</span>
                    @endif
                  </td>
                  <td>{{ $request->updated_at->diffForHumans() }}</td>
                  <td>
                    @if(Auth::user()->role == 'superadmin')
                    <form action="{{ route('superadmin.approve.profile.update', $request->id) }}" method="POST">
                    @else
                      <form action="{{ route('admin.approve.profile.update', $request->id) }}" method="POST">
                    @endif
                      @csrf
                      @method('PUT')
                        <button type="submit" class="btn btn-warning float-ship-btn">
                      {{-- <i class="fa fa-taxi"></i> --}}
                      Approve
                      {{-- <i class="fa fa-plus my-float"></i> --}}
                      </button>
                    </form>
                      

                      <a href="#" class="btn btn-danger float-ship-btn" data-toggle="modal" data-target="#launchMobileAgentModal-{{$request->id}}">
                      {{-- <i class="fa fa-taxi"></i> --}}
                      Reject
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
                            @if(Auth::user()->role == 'superadmin')
                              <form class="form-element" action="{{ route('superadmin.reject.profile.update.request', $request->id) }}" method="POST">
                            @else
                              <form class="form-element" action="{{ route('admin.reject.profile.update.request', $request->id) }}" method="POST">
                            @endif
                                @csrf
                                @method('PUT')
                           
                                  <div class="form-group">
                                    <label class="control-label">Reason for rejection</label>
                                    <textarea class="form-control" name="reason"></textarea>
                                  </div> 
                               
                                
                                

                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <div class="col-sm-10">
                                        <button type="submit" class="btn btn-warning">Send <i class="fa fa-check"></i></button>
                                      </div>
                                    </div>
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


