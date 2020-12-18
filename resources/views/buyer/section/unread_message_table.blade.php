

<!-- Content Header (Page header) -->
@if (url()->current() == !route('buyer.dashboard') )
<section class="content-header p-3 box">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Message </a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
@endif

@include('layouts.backend_partials.status')

<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title"> {{ url()->current() == route('buyer.message.unread') ?  'Unread Message' : 'Recent Unread Message' }} {{ $unread_message->count() }} </h3>


    @if (url()->current() == route('buyer.message.all') )
    <div class="box-tools">
      <form class="" method="GET" action="{{ route('admin.service.search') }}">
        <div class="input-group input-group-sm" style="width: 150px;">
          <input type="search" class="form-control pull-right" placeholder="Search" name="query"  value="{{ isset($query) ? $query : '' }}" required>

          <div class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>
    @endif 

  </div>
  <!-- /.box-header -->
  <div class="box-body ">
    <table class="table table-bordered">

      <tbody>

        <tr>
          <th> # </th>
          <th> From </th>
          <th> Email </th>
          <th> Message </th>
          <th> Status </th>
          <th> Date </th>
          <th> Action </th>
        </tr>

        <tr>
          @foreach($unread_message as $key => $unread_messages)
          <td><a href="javascript:void(0)"> {{ $key + 1 }} </a></td>
          <td> {{ $unread_messages->buyer_name }} </td>
          <td> {{ $unread_messages->buyer_email }} </td>
          <td> {{ Str::limit($unread_messages->description, 30) }} </td>
          <td> {{ $unread_messages->status == 1 ? 'Active' : 'Pending' }} </td>
          <td> {{ $unread_messages->created_at->diffForHumans() }} </td>

          <td class="center">
            <a href=" {{ route('buyer.message.view',$unread_messages->slug) }} " class="btn btn-warning "><i class="fa fa-eye"></i></a>
          </td>

        </tr>

        @endforeach

      </tbody>
    </table>
  </div>
  <!-- /.box-body -->

  @if (url()->current() == route('buyer.message.unread') )
  <div class="box-footer clearfix">

    {{ $unread_message->links() }}

  </div>
  @endif

</div>

@include('seller/modal/create_service') 

