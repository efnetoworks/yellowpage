
@extends('layouts.admin')

@section('title')
Active Service | 
@endsection

@section('content')

<br>
<hr>

<div class="container">

    <section class="content">


@include('admin/section/active_service_table') 

</section>

</div>

@endsection