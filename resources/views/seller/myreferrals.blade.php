@extends('layouts.seller')

@section('title', 'My Referrals | ')

@section('content')

    <style>

    </style>

    <div class="content-wrapper" style="min-height: 868px;">
        @include('layouts.backend_partials.status')

        <section class="content-header">
            <h3 class="page-title">My Referrals </h3>
            <p class="page-description">You can see all the people you have referred.</p>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            {{-- <h3 class="box-title"> My Refferals </h3> --}}
                            <h6 class="box-subtitle"> Sorting is from the most recent. </h6>
                        </div>

                        <!-- /.box-header -->

                        <div id="main_referer_table" class="box-body">
                            <div class="table-responsive">
                                <table class="display table table-bordered data_table_main">
                                    <thead>
                                        <tr>
                                            <th> S/N </th>
                                            <th> Referee Name </th>

                                            <!-- <th> Referer Link </th> -->
                                            <!-- <th> Agent Code </th> -->
                                            <th> Has Badge? </th>
                                            <th> Featured Count </th>
                                            <th> Date Created </th>
                                            <!-- <th> Status </th>
                                                <th> Action </th> -->
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($myreferrals as $key => $myreferral)
                                            <tr role="row" class="odd">
                                                <td><a href="javascript:void(0)"> {{ $key + 1 }} </a></td>
                                                <td> {{ $myreferral->user->name }} </td>
                                                <!-- <td> {{ $myreferral->user->refererLink }} </td> -->
                                                <!-- <td> {{ $myreferral->user->refererAmount }} </td> -->
                                                <td> {{ $myreferral->hasBadge->first() ? 'Yes' : 'No' }} </td>

                                                <td>
                                                    @if($myreferral->user->services->count())
                                                        <p id="active_text">{{$myreferral->user->services->count()}} &nbsp; Services</p>
                                                        <button type="button" class="btn btn-primary"
                                                        data-toggle="modal" data-target="#allServicess{{ $myreferral->id }}">
                                                        See Featured Services
                                                        </button>
                                                    @elseif($myreferral->user->services->count() == 0)
                                                        <span id="active_text2">No Service Yet!</span>
                                                    @endif
                                                    <div class="modal fade" id="allServicess{{ $myreferral->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="allUsers{{ $myreferral->id }}Label">All Featured Services</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                {{-- <th scope="col">#</th> --}}
                                                                                <th scope="col">Service Name</th>
                                                                                <th scope="col">Date Created</th>
                                                                                <th scope="col">Approved?</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($myreferral->user->services as $key => $service)
                                                                                @foreach ($service->featured as $aservice)
                                                                                    <tr>
                                                                                        {{-- <th>{{ $key + 1 }}</th> --}}
                                                                                        <td><a href="{{ route('serviceDetail', $aservice->service->slug) }}">{{$aservice->service->name}}</a></td>
                                                                                        <td>{{$aservice->service->created_at}}</td>
                                                                                        <td>{{$aservice->service->is_approved ? 'Approved' : 'Not Yet Approved'}}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td> {{ $myreferral->created_at->diffForHumans() }} </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>



                        {{-- @foreach($myreferral->user->services as $key => $service)
                            @if ($service->is_featured)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td><a href="{{ route('serviceDetail', $service->slug) }}">{{$service->name}}</a></td>
                                    <td>{{$service->created_at}}</td>
                                    <td>{{$service->is_approved ? 'Approved' : 'Not Yet Approved'}}</td>
                                </tr>
                            @endif
                        @endforeach --}}




                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
