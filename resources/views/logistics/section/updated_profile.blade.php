<form class="form-element" method="POST" action="{{ route('logistic.profile.updates') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	@method('PUT')
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="inputName" class="control-label">First Name</label>

				<div class="">
					<input type="text" id="name" class="form-control" name="first_name" value=" {{ $updated_profile->first_name }} ">
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="inputName" class="control-label">Last Name</label>

				<div class="">
					<input type="text" id="name" class="form-control" name="last_name" value=" {{ $updated_profile->last_name }} ">
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<img class="profile-user-img img-responsive" src="{{ $updated_profile->profile_image = null ? '/images/user-icon.png' : asset('uploads/users/'.''.$updated_profile->profile_image) }}" alt="User profile picture">
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
				<label for="inputEmail" class="control-label">Company Name</label>

				<div class="">
					<input type="type" class="form-control" name="company_name" value=" {{ $updated_profile->company_name }}">
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="inputName" class="control-label">Email Address</label>

				<div class="">
					<input type="text" id="name" class="form-control" name="email" value=" {{ $updated_profile->email }} ">
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		
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
					<select class="form-control" name="state_id" id="state_register">
						<option value="1">--select state--</option>
						@foreach ($states as $state)
							<option value="{{$state->id}}">{{$state->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="inputName" class="control-label">City</label>

				<div class="">
					<select class="form-control" name="lga" id="city_register">
						<option value="1">--select city--</option>
						
					</select>
				</div>
			</div>
		</div>
		
	</div>
	{{-- <div class="row">
		<div class="col-md-6">
			<label for="address">State</label>

			<div class="">
				<select>
					
				</select>
				
			</div>
		</div>
		<div class="col-md-6">
			<label for="address">City</label>

			<div class="">
				<input type="text" id="address" class="form-control" name="address" value=" {{ $updated_profile->address }} ">
			</div>
		</div>
	</div> --}}
	<div class="row">
		<div class="col-md-12">
			<label for="address">Address</label>

			<div class="">
				<input type="text" id="address" class="form-control" name="address" value=" {{ $updated_profile->address }} ">
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
						@if($updated_profile->identification_type != '')
						<option value="{{ $updated_profile->identification_type }}">{{ $updated_profile->identification_type }}</option>
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
					<input type="text" id="bank_name" class="form-control" name="identification_number" value="{{ $updated_profile->identification_id ? $updated_profile->identification_id : '' }}" placeholder="Enter the id number">
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				@if($updated_profile->document != '')
				<label>Download</label>
				<br>
				<a href="{{ route('logistic.download.doc', $updated_profile->slug) }}" class="text text-danger">Click here to download</a>
					{{-- <button type="button" class="btn btn-default">Download CAC Document</button> --}}
					<br>
					or
					<br>
					<label>Upload</label>
					<div class="">
						<input type="file" id="bank_name" class="form-control" name="document">
					</div>
				@else
				<label for="bank_name" class="control-label">Upload Means of ID</label>
				<div class="">
					<input type="file" id="bank_name" class="form-control" name="document" accept="image/*">
				</div>
				@endif
				{{-- <label for="bank_name" class="control-label">BVN <span style="color: red;">*</span></label>
				<div class="">
					<input type="number" class="form-control" name="bvn" value="{{Auth::guard('logistic')->user()->bvn ? Auth::guard('logistic')->user()->bvn : '' }}" placeholder="Enter your bvn">
				</div> --}}
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="bank_name" class="control-label">CAC? (optional)</label>
				<div class="">
					<select class="form-control" name="cac">
						<option value="{{ $updated_profile->cac }}">{{ ($updated_profile->cac) ? 'Yes' : 'No' }}</option>
						<option default>Do you have CAC documents?</option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				@if($updated_profile->cac_document != '')
				<label>Download</label>
				<br>
				<a href="{{ route('logistic.download.doc', $updated_profile->slug) }}" class="text text-danger">Click here to download</a>
					{{-- <button type="button" class="btn btn-default">Download CAC Document</button> --}}
					<br>
					or
					<br>
					<label>Upload</label>
					<div class="">
						<input type="file" id="bank_name" class="form-control" name="cac_document">
					</div>
				@else
				<label for="bank_name" class="control-label">Upload CAC document</label>
				<div class="">
					<input type="file" id="bank_name" class="form-control" name="cac_document">
				</div>
				@endif
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="bank_name" class="control-label">Type of Bike <span style="color: red;">*</span></label>
				<div class="">
					<input type="text" class="form-control" name="type_of_bike" value="{{ $updated_profile->type_of_bike }}" placeholder="Which kind of bike do you own?">
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="bank_name" class="control-label">Bike Plate <span style="color: red;">*</span></label>
				<div class="">
					<input type="text" id="bank_name" class="form-control" name="plate_number" value="{{ $updated_profile->plate_number }}" placeholder="Enter the plate number of your bike">
				</div>
			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="about" class="control-label">About Company</label>
				<textarea id="" cols="30" rows="10" class="form-control" name="about" placeholder="Enter details here">{{ $updated_profile->about }}</textarea>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-warning"> Update <i class="fa fa-refresh"></i></button>
				</div>
			</div>
		</div>
	</div>


</form>