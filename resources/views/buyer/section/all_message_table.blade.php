

<div class="box">

  <div class="box-header with-border">
    <h3 class="box-title">  All Message {{ $all_message->count() }} </h3>


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
          @foreach($all_message as $key =>  $all_messages)
          <td><a href="javascript:void(0)"> {{ $key + 1 }} </a></td>
          <td> {{ $all_messages->buyer_name }} </td>
          <td> {{ $all_messages->buyer_email }} </td>
          <td> {{ Str::limit($all_messages->description, 30) }} </td>
          <td> {{ $all_messages->status == 1 ? 'Active' : 'Pending' }} </td>
          <td> {{ $all_messages->created_at->diffForHumans() }} </td>

          <td class="center">
            <a href=" {{ route('buyer.message.view',$all_messages->slug) }} " class="btn btn-warning "><i class="fa fa-eye"></i></a>
            <a href="{{ route('buyer.message.reply',$all_messages->slug) }} " class="btn btn-warning "><i class="fa fa-reply"></i></a>
          </td>
        </tr>

        @endforeach

      </tbody>
    </table>
  </div>
  <!-- /.box-body -->

  @if (url()->current() == !route('buyer.dashboard') )
  <div class="box-footer clearfix">

    {{ $all_message->links() }} 

  </div>
  @endif

</div>


