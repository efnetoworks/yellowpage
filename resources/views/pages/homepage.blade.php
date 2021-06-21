@extends('layouts.frontend.app')

@section('page-title', 'Welcome to the world largest online platform')


@section('extra-styles')
<style>

</style>
@endsection

@section('content')
    @include('layouts.frontend.partials._banner')
    @include('layouts.frontend.partials._search')

    <div class="body-content" style="margin-top: 50px">
       <div class="top-section body-container">
           <div class="row">
               <div class="col-md-2">
                    <div class="left-side" style="box-shadow: 0 0 35px rgb(0 0 0 / 10%);padding:20px">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, nobis impedit laborum enim unde ipsam labore fugit officia, ab, porro aperiam adipisci! Accusamus doloremque, odio maiores necessitatibus veniam alias repudiandae.
                    </div>
               </div>
               <div class="col-md-8">
                @include('layouts.frontend.partials._category_listings')
               </div>
               <div class="col-md-2">
                    <div class="left-side" style="box-shadow: 0 0 35px rgb(0 0 0 / 10%);padding:20px">
                        <div class="widget">
                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object" src="{{ asset('assets/frontend/img/sub-properties/sub-properties-1.jpg') }}" alt="sub-properties">
                                </div>
                                <div class="media-body align-self-center">
                                    <h3 class="media-heading">
                                        <a href="#">Modern Design Building</a>
                                    </h3>
                                    <p>Apr 15, 2019 | $2041,000</p>
                                </div>
                            </div>
                                <div class="media-left">
                                    <img class="media-object" src="{{ asset('assets/frontend/img/sub-properties/sub-properties-1.jpg') }}" alt="sub-properties">
                                </div>
                                <div class="media-body align-self-center">
                                    <h3 class="media-heading">
                                        <a href="#">Modern Design Building</a>
                                    </h3>
                                    <p>Apr 15, 2019 | $2041,000</p>
                                </div>
                            </div>
                                <div class="media-left">
                                    <img class="media-object" src="{{ asset('assets/frontend/img/sub-properties/sub-properties-1.jpg') }}" alt="sub-properties">
                                </div>
                                <div class="media-body align-self-center">
                                    <h3 class="media-heading">
                                        <a href="#">Modern Design Building</a>
                                    </h3>
                                    <p>Apr 15, 2019 | $2041,000</p>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
       </div>

        @include('layouts.frontend.partials._featured_services')
    </div>
@endsection
