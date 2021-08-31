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
			<div class="col-md-4">

				<!-- Profile Image -->
				<div class="box box-warning">
					<div class="box-body box-profile">

						<img class="profile-user-img img-responsive img-circle" src="{{ Auth::guard('logistic')->user()->image = null ? '/images/user-icon.png' : asset("/storage/".Auth::guard('logistic')->user()->profile_image) }}" alt="User profile picture">

						<h3 class="profile-username text-center"> {{ Auth::guard('logistic')->user()->name }} </h3>
						<form action="{{ route('logistic.upload.image') }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="text-center" style="padding-top: 10px;">
								<div class="custom-file">
								  <input type="file" class="custom-file-input" id="customFile" name="profile_image" style="padding-left: 150px; display: none;">
								  <label class="custom-file-label" for="customFile">Click to choose profile image/logo</label>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-warning">Upload</button>
								</div>
							</div>
							
						</form>
						<div class="row">
							<div class="col-xs-12">
								<div class="profile-user-info">
									<p>Email address </p>
									<h5> {{ Auth::guard('logistic')->user()->email }} </h5>
									<p>Phone</p>
									<h5> {{ Auth::guard('logistic')->user()->phone }}</h5>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
				<div class="col-md-8">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">

							<li class="active"><a href="#timeline" data-toggle="tab">Update Profile</a></li>
							<li><a href="#password" data-toggle="tab">Change Password</a></li>
							<li><a href="#bankaccount" data-toggle="tab">Identification Details</a></li>
						</ul>

						<div class="tab-content">
							<!-- /.tab-pane -->

							<div class="active tab-pane" id="timeline">

								<form class="form-horizontal form-element" method="POST" action="{{ route('logistic.profile.updates') }}" enctype="multipart/form-data">
									{{ csrf_field() }}
									@method('PUT')
									<div class="form-group">
										<label for="inputName" class="col-sm-2 control-label">Full Name</label>

										<div class="col-sm-10">
											<input type="text" id="name" class="form-control" name="name" value=" {{ Auth::guard('logistic')->user()->name }} ">
										</div>
									</div>


									<div class="form-group">
										<label for="inputEmail" class="col-sm-2 control-label">Email</label>

										<div class="col-sm-10">
											<input type="email" class="form-control" name="email" value=" {{ Auth::guard('logistic')->user()->email }}">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-sm-2 control-label">Company</label>

										<div class="col-sm-10">
											<input type="type" class="form-control" name="company_name" value=" {{ Auth::guard('logistic')->user()->company_name }}">
										</div>
									</div>

										<div class="form-group">
											<label for="inputPhone" class="col-sm-2 control-label">Phone</label>

											<div class="col-sm-10">
                                                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" class="form-control"  minlength="11" maxlength="11" name="phone" value="{{ Auth::guard('logistic')->user()->phone }}">
                                            </div>
										</div>


								<!-- <div class="form-group">
									<label for="inputExperience" class="col-sm-2 control-label">Image</label>

									<div class="col-sm-10">
										<input type="file" class="form-control" name="file">
									</div>
								</div> -->


								<div class="form-group">
									<label for="inputSkills" class="col-sm-2 control-label">State</label>

									<div class="col-sm-10">
										<select class="form-control" name="state_id" disabled>
											<option value="1">Abuja</option>
										</select>
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


						<div class="tab-pane" id="bankaccount">
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
									<label for="bank_name" class="col-sm-2 control-label">Identification Number</label>
									<div class="col-sm-10">
										<input type="text" id="bank_name" class="form-control" name="identification_number" value="{{ Auth::guard('logistic')->user()->identification_id ? Auth::guard('logistic')->user()->identification_id : '' }}" placeholder="Enter the id number">
									</div>
								</div>


								<div class="form-group">
									<label for="account_number" class="col-sm-2 control-label">BVN</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" name="bvn" value="{{Auth::guard('logistic')->user()->bvn ? Auth::guard('logistic')->user()->bvn : '' }}" placeholder="Enter your bvn">
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

					</div>

				</div>

			</div>

		</div>


	</section>

</div>


@endsection
