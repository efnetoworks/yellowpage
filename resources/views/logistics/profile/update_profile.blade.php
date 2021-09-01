@extends('layouts.logistic')

@section('title')
Update Profile |
@endsection

@section('content')

<div class="content-wrapper" style="min-height: 868px;">

	@include('layouts.logistics_partials.status')

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

								<form class="form-element" method="POST" action="{{ route('logistic.profile.updates') }}" enctype="multipart/form-data">
									{{ csrf_field() }}
									@method('PUT')
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputName" class="control-label">First Name</label>

												<div class="">
													<input type="text" id="name" class="form-control" name="first_name" value=" {{ Auth::guard('logistic')->user()->first_name }} ">
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputName" class="control-label">Last Name</label>

												<div class="">
													<input type="text" id="name" class="form-control" name="last_name" value=" {{ Auth::guard('logistic')->user()->last_name }} ">
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<img class="profile-user-img img-responsive img-circle" src="{{ Auth::guard('logistic')->user()->image = null ? '/images/user-icon.png' : '/images/user-icon.png' }}" alt="User profile picture">
												<div class="custom-file text-center">
												  <input type="file" class="custom-file-input" id="customFile" name="profile_image" style="padding-left: 150px; display: none;">
												  <label class="custom-file-label" for="customFile">Click to choose profile image/logo</label>
												</div>
											</div>
										</div>
										
									</div>
									<div class="row" style="padding-top: 10px;">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputEmail" class="control-label">Company</label>

												<div class="">
													<input type="type" class="form-control" name="company_name" value=" {{ Auth::guard('logistic')->user()->company_name }}">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputName" class="control-label">Email Address</label>

												<div class="">
													<input type="text" id="name" class="form-control" name="email" value=" {{ Auth::guard('logistic')->user()->email }} ">
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputName" class="control-label">Phone</label>

												<div class="">
													<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" class="form-control"  minlength="11" maxlength="11" name="phone" value="{{ Auth::guard('logistic')->user()->phone }}">
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="inputName" class="control-label">State</label>

												<div class="">
													<select class="form-control" name="state_id" disabled>
														<option value="1">Abuja</option>
													</select>
												</div>
											</div>
										</div>
										
									</div>

									<div class="row">
										<div class="col-md-12">
											<label for="address">Address</label>

											<div class="">
												<input type="text" id="address" class="form-control" name="address" value=" {{ Auth::guard('logistic')->user()->email }} ">
											</div>
										</div>
									</div>
									
									<div class="row" style="padding-top: 20px; padding-bottom: 20px;">

										<div class="col-md-4 card">
											<div class="card-header">
												<h3 class="text text-warning">Means of Identification</h3>
											</div>
										</div>
										
									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="bank_name" class="control-label">Identification Type <span style="color: red;">*</span></label>
												<div class="">
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
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="bank_name" class="control-label">Identification Number <span style="color: red;">*</span></label>
												<div class="">
													<input type="text" id="bank_name" class="form-control" name="identification_number" value="{{ Auth::guard('logistic')->user()->identification_id ? Auth::guard('logistic')->user()->identification_id : '' }}" placeholder="Enter the id number">
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="bank_name" class="control-label">BVN <span style="color: red;">*</span></label>
												<div class="">
													<input type="number" class="form-control" name="bvn" value="{{Auth::guard('logistic')->user()->bvn ? Auth::guard('logistic')->user()->bvn : '' }}" placeholder="Enter your bvn">
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="bank_name" class="control-label">CAC? (optional)</label>
												<div class="">
													<select class="form-control" name="cac">
														<option value="{{ Auth::guard('logistic')->user()->cac }}">{{ (Auth::guard('logistic')->user()->cac) ? 'Yes' : 'No' }}</option>
														<option default>Do you have CAC documents?</option>
														<option value="1">Yes</option>
														<option value="0">No</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="bank_name" class="control-label">Upload CAC document</label>
												<div class="">
													<input type="file" id="bank_name" class="form-control" name="cac_document">
												</div>
											</div>
										</div>

									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="bank_name" class="control-label">Type of Bike <span style="color: red;">*</span></label>
												<div class="">
													<input type="text" class="form-control" name="type_of_bike" value="{{ Auth::guard('logistic')->user()->type_of_bike }}" placeholder="Which kind of bike do you own?">
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="bank_name" class="control-label">Bike Plate <span style="color: red;">*</span></label>
												<div class="">
													<input type="text" id="bank_name" class="form-control" name="plate_number" value="{{ Auth::guard('logistic')->user()->plate_number }}" placeholder="Enter the plate number of your bike">
												</div>
											</div>
										</div>

									</div>

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<div class="col-sm-10">
													<button type="submit" class="btn btn-warning">Update <i class="fa fa-refresh"></i></button>
												</div>
											</div>
										</div>
									</div>


									

									


								
							</form>
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
