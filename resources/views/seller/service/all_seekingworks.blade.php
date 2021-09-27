@extends('layouts.seller')

@section('title', 'Your Job Applications | ')

@section('content')

<div class="content-wrapper" style="min-height: 518px;">

	<div class="container">
		@include('layouts.backend_partials.status')
	</div>
    <section class="content-header">
        <h3 class="page-title">Job Applications </h3>
        <p class="page-description">This is a compiled list of all your applications.</p>
    </section>
	<section class="content">

		<div class="row">
			<div class="col-xs-12">



				<div class="box" >
					<div class="box-header">
						{{-- <h3 class="box-title"> Job Applications </h3> --}}
						<h6 class="box-subtitle"> Sorting is from the most recent. </h6>
					</div>

					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
                            <table class="display table table-bordered data_table_main">
                                <thead>
                                    <tr>
                                        <th> SL </th>
                                        <th> Image </th>
                                        <th> Full Name </th>
                                        <th> Job Title </th>
                                        <th> State </th>
                                        <th> Job Type </th>
                                        <th> Expected Salary </th>
                                        <th> Featured </th>
                                        <th> Date </th>
                                        <th>Comments</th>
                                        {{-- <th>Badge Type</th> --}}
                                        <th>Likes</th>
                                        <th> Action </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($all_services as $key => $all_service)
                                        <tr>
                                            <td><a href="javascript:void(0)"> {{ $key + 1 }} </a></td>
                                            <td>
                                                <a href="#">
                                                    <img src="{{asset('uploads/seekingworks')}}/{{$all_service->thumbnail }}"  alt="service image" width="60" class="img-responsive img-rounded">
                                                </a>
                                            </td>
                                            <td> {{ $all_service->fullname }} </td>
                                            <td> {{ $all_service->job_title }} </td>
                                            <td> {{ $all_service->user_state }} </td>
                                            <td> {{ $all_service->job_type }} </td>
                                            <td> {{ $all_service->expected_salary }} </td>
                                            <td> {{ $all_service->paid_featured == 1 ? 'Yes' : 'No' }} </td>
                                            <td> {{ $all_service->created_at->format('d/m/Y') }} </td>
                                            <td><span><i class="fa fa-comments"> </i> {{ $all_service->comments->count() }}</span> </td>
                                            {{-- <td> {{$all_service->badge_type ? $all_service->badge_type : 'No Badges'}}</td> --}}
                                            <td> {{$all_service->likes->count()}}</td>

                                            <td class="center">
                                                <a href="{{ route('user.job.applicant.preview.detail', ['slug' => $all_service->slug]) }} " class="btn btn-warning" target="_blank"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('seekingwork.update.view', $all_service->slug) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                                <a onclick="deleteService({{ $all_service->id }})" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>


                        {{-- <p>{{ $all_services->links() }}</p> --}}
					</div>
					<!-- /.box-body -->
				</div>


				<!-- /.content -->
			</div>



		</div>

	</div>
</section>


<script>
    function deleteService(id) {
        event.preventDefault();

        if (confirm("Are you sure?")) {

            $.ajax({
                url: '/seekingworkDelete/' + id,
                method: 'get',
                success: function(result){
                    window.location.assign(window.location.href);
                    toastr.error('Application Deleted Successfully!')
                }
            });

        } else {
            console.log('Delete process cancelled');
        }
    }
</script>

@endsection


