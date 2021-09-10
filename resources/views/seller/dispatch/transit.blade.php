@extends('layouts.seller')

@section('title', 'Dispatch Requests in Transit | ')

@section('content')

<div class="content-wrapper" style="min-height: 518px;">

	<div class="container">
		@include('layouts.backend_partials.status')
	</div>
    <section class="content-header">
        <h3 class="page-title">Request(s) in Transit</h3>
        <p class="page-description">This is a compiled list of all your request(s) in transit.</p>
    </section>
	<section class="content">

		<div class="row">
			<div class="col-xs-12">



				<div class="box" >
					<div class="box-header">
						<h3 class="box-title"> Dispatch Request(s) in Transit</h3>
						<h6 class="box-subtitle"> Sorting is from the most recent. </h6>
					</div>

					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
                            <table class="display table table-bordered data_table_main">
                                <thead>
                                    <tr>
                                        <th> SL </th>
                                        <th> Product </th>
                                        <th> Tracking Number </th>
                                        <th> Dispatch Company </th>
                                        <th> Reciever's Name </th>
                                        <th> Reciever's Email </th>
                                        <th> Reciever's Phone </th>
                                        <th>Reciever's Address</th>
                                        {{-- <th>Badge Type</th> --}}
                                        <th>Status</th>
                                        {{-- <th> Action </th> --}}
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($deliveries as $key => $delivery)
                                        <tr>
                                            <td><a href="javascript:void(0)"> {{ $key + 1 }} </a></td>
                                            <td> <a href="{{ route('serviceDetail', $delivery->service->slug) }}" style="color: #ca8309" target="_blank">{{ $delivery->service->name }}</a> </td>
                                            <td> {{ $delivery->tracking_id }}</td>
                                            <td>
                                               {{ $delivery->logistic->company_name }}
                                            </td>
                                            <td> {{ $delivery->customer_name }} </td>
                                            <td> {{ $delivery->customer_email }} </td>
                                            <td>{{ $delivery->customer_phone }}</td>
                                            <td> {{ $delivery->customer_address }}</td>
                                            <td>In transit </td>
                                            {{-- <td> {{$all_service->badge_type ? $all_service->badge_type : 'No Badges'}}</td> --}}
                                            

                                            {{-- <td class="center">
                                                <a href="{{ route('service.view', $all_service->slug) }} " class="btn btn-warning "><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('service.update.view', $all_service->slug) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                                <a onclick="deleteService({{ $all_service->id }})" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td> --}}
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
                url: '/service/' + id,
                method: 'get',
                success: function(result){
                    window.location.assign(window.location.href);
                    toastr.error('Service Deleted Successfully!')
                }
            });

        } else {
            console.log('Delete process cancelled');
        }
    }
</script>

@endsection


