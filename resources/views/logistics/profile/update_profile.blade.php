@extends('layouts.logistic')

@section('title')
Update Profile |
@endsection

@section('content')

<div class="content-wrapper" style="min-height: 868px;">

	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

	<section class="content-header">
		<h3 class="page-title">Your Profile</h3>
		<p class="page-description">This page is for managing your logistic profile details.</p>
	</section>

	<section class="content">

		<div class="row">
			
				<!-- /.col -->
				<div class="col-lg-12 align-self-center pad-0">
					<div class="nav-tabs-custom">
						{{-- <ul class="nav nav-tabs">

							<li class="active"><a href="#timeline" data-toggle="tab">Update Profile</a></li>
							<li><a href="#password" data-toggle="tab">Change Password</a></li>
							<li><a href="#bankaccount" data-toggle="tab">Identification Details</a></li>
						</ul> --}}

						<div class="row" style="padding-top: 20px; padding-bottom: 20px; padding-left: 10px;">

							<div class="col-md-4 card">
								<div class="card-header">
									<h3 class="text text-warning">Personal Information</h3>
								</div>
							</div>
							
						</div>

						<div class="tab-content">
							<!-- /.tab-pane -->

							<div class="active tab-pane" id="timeline">

								@if($updated_profile == null)
									@include('logistics.section.initial_profile')
								@elseif($updated_profile->approval_status == 0)
									@include('logistics.section.initial_profile') 
								@else
								 	@include('logistics.section.updated_profile')
								@endif
							
							
							</div>
						<!-- /.tab-pane -->


						<div class="tab-pane" id="password">
							<form class="form-horizontal form-element" method="POST" action="{{ route('logistic.update.password') }}" enctype="multipart/form-data">
								{{ csrf_field() }}
								@method('PUT')
								<div class="form-group">
									<label for="inputOld_password" class="col-sm-2 control-label">Current Password</label>

									<div class="col-sm-10">
										<input class="form-control" name="old_password" type="password" placeholder="Enter Your current Password">
									</div>
								</div>
								<div class="form-group">
									<label for="inputNew_password" class="col-sm-2 control-label">New Password</label>

									<div class="col-sm-10">
										<input class="form-control" name="new_password" type="password">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword_confirmation" class="col-sm-2 control-label">Confirm New Password</label>

									<div class="col-sm-10">
										<input class="form-control" name="password_confirmation" type="password">
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-warning">Update <i class="fa fa-refresh"></i></button>
									</div>
								</div>
							</form>
						</div>


						<!-- /.tab-pane -->


						{{-- <div class="tab-pane" id="bankaccount">
							<form class="form-horizontal form-element" method="POST" action="{{ route('logistic.update.id') }}">
								@csrf
								@method('PUT')
								<div class="form-group">
									<label for="bank_name" class="col-sm-2 control-label">Identification Type</label>
									<div class="col-sm-10">
										<select class="form-control" name="identification_type">
											@if(Auth::guard('logistic')->user()->identification_type != '')
											<option value="{{ Auth::guard('logistic')->user()->identification_type }}">{{ Auth::guard('logistic')->user()->identification_type }}</option>
											@endif
											<option value="National ID">National ID</option>
											<option value="Voters Card">Voters Card</option>
											<option value="Drivers License">Drivers License</option>
											<option value="International Passport">International Passport</option>
										</select>
									</div>
								</div>

								


								<div class="form-group">
									<label for="account_number" class="col-sm-2 control-label">BVN</label>
									<div class="col-sm-10">
										
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-warning">Update <i class="fa fa-refresh"></i></button>
									</div>
								</div>
							</form>
						</div> --}}
						<!-- /.tab-pane -->

					</div>

				</div>

			</div>


		</div>


	</section>

</div>


@endsection
