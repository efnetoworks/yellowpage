
@extends('layouts.seller')

@section('title', 'Update Service | ')

@section('content')

<style>
    .form-text{
        display: block
    }
</style>

<div class="content-wrapper" style="min-height: 868px;">

  @include('layouts.backend_partials.status')


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="row clearfix">
                    <form class="" method="POST" action="{{route('seekingwork.update.store', $service->slug )}}" enctype="multipart/form-data">@csrf
                        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <i class="fa fa-plus"></i>
                                    <h2 class="box-title"><strong>Create Your CV's Page</strong></h2>
                                    <small class="text-danger">* please fill all astericked fields</small>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label class="form-label">Full Name </label><small class="text-danger">*</small>
                                            <input id='name' type="text" required name="name" value="{{ $service->fullname }}" class="form-control" placeholder="Enter your fullname here (e.g. James Tapo)">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Phone</label><small class="text-danger">*</small>
                                                <input id="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="text" class="form-control" value="{{ $service->phone }}" placeholder="Enter your phone number (e.g. 090XXXXXXXXXXX)" name="phone" minlength="11" maxlength="11" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Job Title</label><small class="text-danger">*</small>
                                                <input id='name' type="text" name="job_title" value="{{ $service->job_title }}" class="form-control" placeholder="What type of job are you looking for? (e.g. Accounting Finance)" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Your years of experience in this field?</label><small class="text-danger">*</small>
                                                <input type="number" name="job_experience" value="{{ $service->job_experience }}" min="0" value="0" class="form-control" placeholder="0" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Job Type</label><small class="text-danger">*</small>
                                                <select class="form-control" name="job_type" value="{{ $service->job_type }}" required>
                                                    <option value="Full Time" {{ $service->job_type == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                                    <option value="Part Time" {{ $service->job_type == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                                    <option value="Temporary" {{ $service->job_type == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                                                    <option value="Contract" {{ $service->job_type == 'Contract' ? 'selected' : '' }}>Contract</option>
                                                    <option value="Internship" {{ $service->job_type == 'Internship' ? 'selected' : '' }}>Internship</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Still Studying</label>
                                                <select class="form-control" name="still_studying" value="{{ $service->still_studying }}" required>
                                                    <option value="No" selected>No</option>
                                                    <option value="Yes">Yes</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Gender</label><small class="text-danger">*</small>
                                                <select class="form-control" name="gender" value="{{ $service->gender }}" required>
                                                    <option value="">- Select gender type -</option>
                                                    <option value="Male" {{ $service->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female" {{ $service->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Age</label><small class="text-danger">*</small>
                                                <input type="number" name="age" class="form-control" min="0" value="{{ $service->age }}" placeholder="Enter your age (e.g. 24)" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Marital Status</label>
                                                <select class="form-control" name="marital_status" value="{{ $service->marital_status }}">
                                                    <option value="">- Select marital status -</option>
                                                    <option value="Single" {{ $service->marital_status == 'Single' ? 'selected' : '' }}>Single</option>
                                                    <option value="Married" {{ $service->marital_status == 'Married' ? 'selected' : '' }}>Married</option>
                                                    <option value="Divorced" {{ $service->marital_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Employment Status</label><small class="text-danger">*</small>
                                                <select class="form-control" name="employment_status" value="{{ $service->employment_status }}">
                                                    <option value="Unemployed" {{ $service->employment_status == 'Unemployed' ? 'selected' : '' }}>Unemployed</option>
                                                    <option value="Employed" {{ $service->employment_status == 'Employed' ? 'selected' : '' }}>Employed</option>
                                                    <option value="Self Employed" {{ $service->employment_status == 'Self Employed' ? 'selected' : '' }}>Self-employed</option>
                                                    <option value="Retired Pensioner" {{ $service->employment_status == 'Retired Pensioner' ? 'selected' : '' }}>Retired/Pensioner</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Highest Qualification</label><small class="text-danger">*</small>
                                                <select class="form-control" name="highest_qualification" value="{{ $service->highest_qualification }}">
                                                    <option value="High School (S.S.C.E)" {{ $service->highest_qualification == 'High School (S.S.C.E)' ? 'selected' : '' }}>High School (S.S.C.E)</option>
                                                    <option value="Degree" {{ $service->highest_qualification == 'High School (S.S.C.E)' ? 'selected' : '' }}>Degree</option>
                                                    <option value="Diploma" {{ $service->highest_qualification == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                                    <option value="HND" {{ $service->highest_qualification == 'HND' ? 'selected' : '' }}>HND</option>
                                                    <option value="OND" {{ $service->highest_qualification == 'OND' ? 'selected' : '' }}>OND</option>
                                                    <option value="MBA/MSc" {{ $service->highest_qualification == 'MBA/MSc' ? 'selected' : '' }}>MBA/MSc</option>
                                                    <option value="MBBS" {{ $service->highest_qualification == 'MBBS' ? 'selected' : '' }}>MBBS</option>
                                                    <option value="MPhil/PhD" {{ $service->highest_qualification == 'MPhil/PhD' ? 'selected' : '' }}>MPhil/PhD</option>
                                                    <option value="N.C.E" {{ $service->highest_qualification == 'N.C.E' ? 'selected' : '' }}>N.C.E</option>
                                                    <option value="Others" {{ $service->highest_qualification == 'Others' ? 'selected' : '' }}>Others</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Expected Salary</label><small class="text-danger">*</small>
                                                <select class="form-control" name="expected_salary" value="{{ $service->expected_salary }}">
                                                    <option value="&#8358;50,000" {{ $service->employment_status == '&#8358;50,000' ? 'selected' : '' }}>Below	&#8358;50,000</option>
                                                    <option value="&#8358;50,000 - &#8358;75,000" {{ $service->expected_salary == '&#8358;50,000 - &#8358;75,000' ? 'selected' : '' }}>&#8358;50,000 - &#8358;75,000</option>
                                                    <option value="&#8358;75,000 - &#8358;100,000" {{ $service->expected_salary == '&#8358;75,000 - &#8358;100,000' ? 'selected' : '' }}>&#8358;75,000 - &#8358;100,000</option>
                                                    <option value="&#8358;100,000 - &#8358;125,000" {{ $service->expected_salary == '&#8358;100,000 - &#8358;125,000' ? 'selected' : '' }}>&#8358;100,000 - 125,000</option>
                                                    <option value="&#8358;125,000 - &#8358;150,000" {{ $service->expected_salary == '&#8358;125,000 - &#8358;150,000' ? 'selected' : '' }}>&#8358;125,000 - &#8358;150,000</option>
                                                    <option value="&#8358;150,000 - &#8358;200,000" {{ $service->expected_salary == '&#8358;150,000 - &#8358;200,000' ? 'selected' : '' }}>&#8358;150,000 - &#8358;200,000</option>
                                                    <option value="&#8358;200,000 - &#8358;300,000" {{ $service->expected_salary == '&#8358;200,000 - &#8358;300,000' ? 'selected' : '' }}>&#8358;200,000 - &#8358;300,000</option>
                                                    <option value="&#8358;300,000 - &#8358;500,000" {{ $service->expected_salary == '&#8358;300,000 - &#8358;500,000' ? 'selected' : '' }}>&#8358;300,000 - &#8358;500,000</option>
                                                    <option value="Above &#8358;500,000" {{ $service->expected_salary == 'Above &#8358;500,000' ? 'selected' : '' }}>Above &#8358;500,000</option>
                                                    <option value="others" {{ $service->expected_salary == 'others' ? 'selected' : '' }}>Others</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Work Experience</label>
                                                <textarea id='workexperience' name="work_experience" class="form-control summernote" value="{!! $service->work_experience !!}" placeholder="Tell us about your work experience.">{!! $service->work_experience !!}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Education</label><small class="text-danger">*</small>
                                                <textarea id='education' name="education" class="form-control summernote" value="{!! $service->education !!}" placeholder="Tell us about your educational background.">{!! $service->education !!}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Certifications</label>
                                                <textarea id='certifications' name="certifications" class="form-control summernote" value="{!! $service->certifications !!}" placeholder="Tell us about your certifications.">{!! $service->certifications !!}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Skills</label><small class="text-danger">*</small>
                                                <textarea id='skills' name="skills" class="form-control summernote" value="{!! $service->skills !!}" placeholder="Tell us about your skills.">{!! $service->skills !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="box box-default">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Location</label><small class="text-danger">*</small>
                                                <select class="form-control" required id="user_state"  name="user_state">
                                                    <option value="">- Select State -</option>
                                                    @if(isset($states))
                                                        @foreach($states as $state)
                                                            <option value="{{$state->name}}" {{ $service->user_state == $state->name ? 'selected' : '' }}> {{ $state->name }}  </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Local Government</label><small class="text-danger">*</small>
                                                <select class="form-control" id="user_lga" name="user_lga" required>
                                                    <option disabled selected>- 👈 Select a State -</option>
                                                    <option value="{{ $service->user_lga }}" selected>{{ $service->user_lga }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <input id="address" type="text"  value="{{ $service->address }}" class="form-control" name="address" placeholder="Enter your address here.">
                                            </div>
                                        </div>
                                    </div>


                                    {{-- <input id="featured" class="form-check-input" type="checkbox" value="1" name="is_featured" onclick="featuredCheckbox()">
                                            <label class="form-check-label" for="featured"> Do you want this service featured?  <small class="infoLinkNote">(<a data-toggle="modal" data-target="#featuredInfoModal">How it works?</a>)</small></label> --}}

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input id="swfeatured" class="form-check-input" type="checkbox" value="1" name="is_featured" onclick="swfeaturedCheckbox()" {{ $service->is_featured == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="swfeatured"> Do you want this CV featured?  <small class="infoLinkNote">(<a data-toggle="modal" data-target="#featuredInfoModal">How it works?</a>)</small></label>
                                        </div>
                                        <p id="swfeaturedText" class="text-info">This will attract a fee of &#8358;1000 which will be paid before the CV is displayed.</p>

                                        @if ($service->is_featured == 1 && $service->paid_featured == 0)
                                        <li class="list-group-item">
                                            <span class="left">Please make payment now to be featured!</span>
                                            <p><strong>Note:</strong> This CV won't be featured without payment.</p>
                                            <form>
                                                @csrf
                                                <input id="user_email" type="hidden" name="" value="{{Auth::user()->email}}">
                                                <input id="featured_amount" type="hidden" name="amount" value="2000">
                                                <input id="service_id" type="hidden" name="service_id" value="{{$service->id}}">
                                                <script src="https://js.paystack.co/v1/inline.js"></script>

                                                <button type="button" class="btn btn-lg" style="cursor: pointer; display: block; margin-top: 5px; background-color: #cc8a19; color: #fff" onclick="payWithPaystack1(2000)">Make Payment</button>
                                            </form>
                                            <small>You are seeing this because you chose to be featured.</small>
                                        </li>
                                        @endif
                                    </div>
                                </div>

                                <div class="body">
                                    <a href=" {{ route('seller.service.all') }}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                                        <i class="fa fa-arrow-left"></i>
                                        <span> Back</span>
                                    </a>

                                    <button type="submit" id="save_btn"  class="btn btn-warning btn-submit_service btn-lg m-t-15 waves-effect">
                                        <span>Update </span>
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <!-- /.row -->
            </div>
        </div>


        <div class="box box-default">
            <div class="box-header">
                <h2 class="box-title" style="font-weight: 700">Service Images</h2>
                <p class="text-danger" style="font-weight: 2700">Drag and drop more images here to describe your service!</p>
            </div>
            <div class="box-body">
                    @forelse ($service->images as $image)
                        <div style="display: inline-flex; flex-wrap: wrap">
                            <div>
                                <img src="{{ asset('uploads/seekingworks/'.$image->image_path) }}" alt="" style="display: block;width:100px;">
                                @if ($service->images->count() != 1)
                                    <a href="{{ route('service.image.delete', ['id' => $image->id, 'service_id' => $service->id]) }}" style="display:block">Delete</a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p>You don't have other images yet!</p>
                    @endforelse
                </div>

                @if (Auth::User()->badgetype == 1 && $service->images->count() < 10)
                    <p style="color: rgb(252, 85, 85); font-size: 16px"> {{ 10 - $service->images->count() }} image{{ 10 - $service->images->count() > 1 ? 's' : '' }} remaining.</p>
                    <p> {{ 8 - $service->images->count() }} remaining.</p>
                    <form action="{{ route('service.images.store', ['id' => $service->id]) }}" method="POST" class="dropzone" id="dropzone" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-default dz-message">
                            Click here to add your images <br>
                            <small style="color: rgb(182, 66, 66) !important">When you are done click the upload button down below!</small>
                        </div>
                    </form>
                    <br>
                    <center>
                        <button id="submit-all" class="btn btn-success" style="height: 40px;"> Click to upload</button>
                        <a href="{{ route('serviceDetail', ['slug' => $service->slug]) }}" class="btn btn-danger show-page-vs-btn" style="height: 40px; line-height: 29px;" target="_blank"> View Service</a>
                    </center>
                @elseif (Auth::User()->badgetype == 2 && $service->images->count() < 8)
                    <p style="color: rgb(252, 85, 85); font-size: 16px"> {{ 8 - $service->images->count() }} image{{ 8 - $service->images->count() > 1 ? 's' : '' }} remaining.</p>
                    <form action="{{ route('service.images.store', ['id' => $service->id]) }}" method="POST" class="dropzone" id="dropzone" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-default dz-message">
                            Click here to add your images <br>
                            <small style="color: rgb(182, 66, 66) !important">When you are done click the upload button down below!</small>
                        </div>
                    </form>
                    <br>
                    <center>
                        <button id="submit-all" class="btn btn-success" style="height: 40px;"> Click to upload</button>
                        <a href="{{ route('serviceDetail', ['slug' => $service->slug]) }}" class="btn btn-danger show-page-vs-btn" style="height: 40px; line-height: 29px;" target="_blank"> View Service</a>
                    </center>
                @elseif (Auth::User()->badgetype == 3 && $service->images->count() < 6)
                    <p style="color: rgb(252, 85, 85); font-size: 16px"> {{ 6 - $service->images->count() }} image{{ 6 - $service->images->count() > 1 ? 's' : '' }} remaining.</p>
                    <form action="{{ route('service.images.store', ['id' => $service->id]) }}" method="POST" class="dropzone" id="dropzone" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-default dz-message">
                            Click here to add your images <br>
                            <small style="color: rgb(182, 66, 66) !important">When you are done click the upload button down below!</small>
                        </div>
                    </form>
                    <br>
                    <center>
                        <button id="submit-all" class="btn btn-success" style="height: 40px;"> Click to upload</button>
                        <a href="{{ route('serviceDetail', ['slug' => $service->slug]) }}" class="btn btn-danger show-page-vs-btn" style="height: 40px; line-height: 29px;" target="_blank"> View Service</a>
                    </center>
                @elseif (Auth::User()->badgetype == 4 && $service->images->count() < 4)
                    <p style="color: rgb(252, 85, 85); font-size: 16px"> {{ 4 - $service->images->count() }} image{{ 4 - $service->images->count() > 1 ? 's' : '' }} remaining.</p>
                    <form action="{{ route('service.images.store', ['id' => $service->id]) }}" method="POST" class="dropzone" id="dropzone" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-default dz-message">
                            Click here to add your images <br>
                            <small style="color: rgb(182, 66, 66) !important">When you are done click the upload button down below!</small>
                        </div>
                    </form>
                    <br>
                    <center>
                        <button id="submit-all" class="btn btn-success" style="height: 40px;"> Click to upload</button>
                        <a href="{{ route('serviceDetail', ['slug' => $service->slug]) }}" class="btn btn-danger show-page-vs-btn" style="height: 40px; line-height: 29px;" target="_blank"> View Service</a>
                    </center>
                @else
                    <p style="font-size: 16px; text-align:center; margin: 20px 0"><a href="{{ route('seller.service.badges') }}" style="color: #cc8a19;" >Upgrade</a> your account with a badge to upload more images.</p>
                @endif

            </div>


        <div>
            <div id="featuredInfoModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #cc8a19; color: #fff">
                            <h4 class="modal-title">How Featured Service Works</h4>
                        </div>
                        <div class="modal-body">
                            <p>You can take advantage of EFContacts Featured Service to get the attention of your potential customers/clients 😃. <br>
                                Providers who use the featured service will have their service displayed first on all important EFContact pages.
                                A featured service will be given search priority on EFContact. This means that featured services will get displayed first on a search result page.
                            </p>
                            <p><strong>Note:</strong> This will attract a fee of &#8358;2000 which will be paid before the service is display on our website and last for a period of one month.</p>
                            <p><strong>Take advantage of this to get the attention of your potential customers/clients 😃.</strong></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" style="background-color: #cc8a19; color: #fff" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

    <script>

        base_Url = "{{ url('/') }}"

        var _token = $("input[name='_token']").val();
        var paystack_pk = "{{env('paystack_pk')}}";

        // var email1 = $("#email-address3").val();
        var amount = $("#featured_amount").val();
        var email = $("#user_email").val();
        var service_id = document.getElementById("service_id").value;
        function payWithPaystack1() {

            // return console.log('sasas');
             const featuredButton = document.getElementById("featuredPay");
                // $("#featuredPay").attr("disabled", true);
                featuredButton.disabled  = true;

            var handler = PaystackPop.setup({
                key: paystack_pk,
                email: document.getElementById("user_email").value,
                amount: 100000,
                ref: ''+'FEATURED-'+Math.floor((Math.random() * 1000000000) + 1),
                metadata: {
                    custom_fields: [{
                        display_name: "Mobile Number",
                        variable_name: "mobile_number",
                        value: "+2348012345678"
                    }]
                },
                callback: function(response) {
                    // return console.log('sasas');
                    const featuredButton = document.getElementById("featuredPay");
                    featuredButton.disabled  = true;
                    var email = document.getElementById("user_email").value;
                    var service_id = document.getElementById("service_id").value;
                    var amount = $("#featured_amount").val();
                    var ref_no1 =  response.reference;

                    $.ajax({
                      method: "POST",
                      url: base_Url + '/provider/service/create_pay_featured',
                      dataType: "json",
                      data: {
                        _token: _token,
                        email: email,
                        amount: amount,
                        service_id: service_id,
                        ref_no: ref_no1,
                      },
                      success: function (data) {
                          console.log(data)
                          toastr.success("Your Service has been successfully featured");

                      },
                      error: function(error) {
                          console.log(error)
                      }
                    })
                },
                onClose: function() {
                    alert('window closed');
                }
            });
            handler.openIframe();
        }



    </script>




    <script>
      function deleteImage(image) {
        alert(image);
        event.preventDefault();
        if (confirm("Are you sure?")) {

          $.ajax({
            url: 'delete/image/' + id,
            method: 'get',
            success: function(result){
              alert('successfull')
              window.location.assign(window.location.href);
            }
          });

        } else {

          console.log('Delete process cancelled');

        }

      }
    </script>

@endsection


@section('extra-scripts')
    @if (Auth::User()->badgetype == 1 && $service->images->count() != 8)
        <input hidden id="badge_type_1" type="number" value="{{  8 - $service->images->count() }}">
        <input hidden id="user_1_image_remaining" type="number" value="{{ (8 - $service->images->count()) > 1 ? 's' : '' }}">
        <script type="text/javascript">
            Dropzone.options.dropzone = {
                maxFiles: document.getElementById('badge_type_1').value,
                maxFilesize: 10,
                parallelUploads: 7,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                autoProcessQueue: false,
                init: function() {
                    var dpzMultipleFiles = this;
                    var submitButton = document.querySelector("#submit-all");
                    submitButton.addEventListener("click", function () {
                        dpzMultipleFiles.processQueue();
                    });

                    this.on("queuecomplete", function () {
                        location.reload();
                    });
                    this.on("maxfilesexceeded", function(file){
                        toastr.error("You can't upload more than " + document.getElementById('badge_type_1').value + " file"+document.getElementById('user_1_image_remaining').value+".");
                    });
                },
                success: function(file, response)
                {
                    file.previewElement.id = response.success;
                    var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
                    file.previewElement.querySelector("img").alt = response.success;
                    olddatadzname.innerHTML = response.success;
                },
                error: function(file, response)
                {
                    if($.type(response) === "string")
                        var message = response; //dropzone sends it's own error messages in string
                    else
                        var message = response.message;
                    file.previewElement.classList.add("dz-error");
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
                    return _results;
                }
            };
        </script>

    @elseif (Auth::User()->badgetype == 2 && $service->images->count() != 6)
        <input hidden id="badge_type_2" type="number" value="{{ 6 - $service->images->count() }}">
        <input hidden id="user_2_image_remaining" type="number" value="{{ (6 - $service->images->count()) > 1 ? 's' : '' }}">
        <script type="text/javascript">
            Dropzone.options.dropzone = {
                maxFiles: document.getElementById('badge_type_2').value,
                maxFilesize: 10,
                parallelUploads: 5,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                autoProcessQueue: false,
                init: function() {
                    var dpzMultipleFiles = this;
                    var submitButton = document.querySelector("#submit-all");
                    submitButton.addEventListener("click", function () {
                        dpzMultipleFiles.processQueue();
                    });

                    this.on("queuecomplete", function () {
                        location.reload();
                    });
                    this.on("maxfilesexceeded", function(file){
                        toastr.error("You can't upload more than " + document.getElementById('badge_type_2').value + " file"+document.getElementById('user_2_image_remaining').value+".");
                    });
                },
                success: function(file, response)
                {
                    file.previewElement.id = response.success;
                    var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
                    file.previewElement.querySelector("img").alt = response.success;
                    olddatadzname.innerHTML = response.success;
                },
                error: function(file, response)
                {
                    if($.type(response) === "string")
                        var message = response; //dropzone sends it's own error messages in string
                    else
                        var message = response.message;
                    file.previewElement.classList.add("dz-error");
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
                    return _results;
                }
            };
        </script>
    @elseif (Auth::User()->badgetype == 3 && $service->images->count() != 4)
        <input hidden id="badge_type_3" type="number" value="{{  4 - $service->images->count() }}">
        <input hidden id="user_3_image_remaining" type="text" value="{{ (4 - $service->images->count()) > 1 ? 's' : '' }}">
        <script type="text/javascript">
            Dropzone.options.dropzone = {
                maxFiles: document.getElementById('badge_type_3').value,
                maxFilesize: 10,
                parallelUploads: 3,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                autoProcessQueue: false,
                init: function() {
                    var dpzMultipleFiles = this;
                    var submitButton = document.querySelector("#submit-all");
                    submitButton.addEventListener("click", function () {
                        dpzMultipleFiles.processQueue();
                    });

                    this.on("queuecomplete", function () {
                        location.reload();
                    });
                    this.on("maxfilesexceeded", function(file){
                        toastr.error("You can't upload more than " + document.getElementById('badge_type_3').value + " file"+ document.getElementById('user_3_image_remaining').value + ".");
                    });
                },
                success: function(file, response)
                {
                    file.previewElement.id = response.success;
                    var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
                    file.previewElement.querySelector("img").alt = response.success;
                    olddatadzname.innerHTML = response.success;
                },
                error: function(file, response)
                {
                    if($.type(response) === "string")
                        var message = response; //dropzone sends it's own error messages in string
                    else
                        var message = response.message;
                    file.previewElement.classList.add("dz-error");
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
                    return _results;
                }
            };
        </script>
    @elseif (Auth::User()->badgetype == 4 && $service->images->count() != 2)
        <input hidden id="badge_type_4" type="number" value="{{  2 - $service->images->count() }}">
        <input hidden id="user_4_image_remaining" type="number" value="{{ (2 - $service->images->count()) > 1 ? 's' : '' }}">
        <script type="text/javascript">
            Dropzone.options.dropzone = {
                maxFiles: document.getElementById('badge_type_4').value,
                maxFilesize: 10,
                parallelUploads: 1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                autoProcessQueue: false,
                init: function() {
                    var dpzMultipleFiles = this;
                    var submitButton = document.querySelector("#submit-all");
                    submitButton.addEventListener("click", function () {
                        dpzMultipleFiles.processQueue();
                    });

                    this.on("queuecomplete", function () {
                        location.reload();
                    });
                    this.on("maxfilesexceeded", function(file){
                        toastr.error("You can't upload more than " + document.getElementById('badge_type_4').value + " file"+ document.getElementById('user_4_image_remaining').value +".");
                    });
                },
                success: function(file, response)
                {
                    file.previewElement.id = response.success;
                    var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
                    file.previewElement.querySelector("img").alt = response.success;
                    olddatadzname.innerHTML = response.success;
                },
                error: function(file, response)
                {
                    if($.type(response) === "string")
                        var message = response; //dropzone sends it's own error messages in string
                    else
                        var message = response.message;
                    file.previewElement.classList.add("dz-error");
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
                    return _results;
                }
            };
        </script>
    @endif


    <script type="text/javascript">
        var checkBox = document.getElementById("featured");
        var text = document.getElementById("featuredText");
        text.style.display = "none";

        function featuredCheckbbox() {
            if (checkBox.checked == true){
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        }

        $(document).ready(function() {
            var service_id
        });


        $('#categories').on('change',function(){
            var categoryID = $(this).val();

            if(categoryID){
                $.ajax({
                    type:"GET",
                    url: '/api/get-category-list/'+categoryID,
                    success:function(res){
                        if(res){
                        var res = JSON.parse(res);
                            $("#sub_categories ").empty();
                            $.each(res, function(key,value){
                            var chosen_value = value;
                                $("#sub_categories").append(
                                    '<option value="'+chosen_value.id+'">'+chosen_value.name+'</option>'
                                );
                            });
                        }else{
                            $("#sub_categories").empty();
                        }
                    }
                });
            }else{
                $("#sub_categories").empty();
            }
        });
    </script>

    <script type="text/javascript">
        $('#state').on('change',function(){
            var stateID = $(this).val();
            if(stateID){
                $.ajax({
                    type:"GET",
                    url: '/api/get-city-list/'+stateID,
                    success:function(res){
                        if(res){
                        console.log(res);
                        console.log(stateID);
                        $("#city").empty();
                        $.each(res,function(key,value){
                        $("#city").append('<option value="'+value+'">'+value+'</option>');
                        });

                    }else{
                        $("#city").empty();
                    }
                    }
                });
            }else{
                $("#city").empty();
            }

        });

        $(".image-box").click(function(event) {
            var previewImg = $(this).children("img");
            $(this)
            .siblings()
            .children("input")
            .trigger("click");

            $(this)
            .siblings()
            .children("input")
            .change(function() {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var urll = e.target.result;
                    $(previewImg).attr("src", urll);
                    previewImg.parent().css("background", "transparent");
                    previewImg.show();
                    previewImg.siblings("p").hide();
                };
                reader.readAsDataURL(this.files[0]);
            });
        });


        function limitText(limitField, limitCount, limitNum) {
          if (limitField.value.length > limitNum) {
            limitField.value = limitField.value.substring(0, limitNum);
          } else {
            limitCount.value = limitNum - limitField.value.length;

            if (limitCount.value == 0) {
                limitField.style.border = '1px solid red'
                limitCount.style.color = 'red'
            }else{
                limitField.style.border = '1px solid #d2d6de'
                limitCount.style.color = '#333333'
            }
          }
        }

    </script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script type="text/javascript">
        $('.summernote').summernote({
            height: 120,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    </script>
@endsection
