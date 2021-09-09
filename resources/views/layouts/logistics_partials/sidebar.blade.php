
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image">
          {{-- <img src="{{ Auth::guard('logistic')->user()->image == null ? '/uploads/users/user-icon.png' : '/uploads/users/'.Auth::guard('agent')->user()->image  }}" class="img-circle" alt="User Image"> --}}
        </div>
        <div class="info">
          {{-- <p> {{ Auth::guard('logistic')->user()->name }} </p> --}}
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">

        <li  class="{{ url()->current() == route('logistics_dashboard') ? 'active' : '' }}">
          <a href="{{ route('logistics_dashboard') }}">
            <i class="fa fa-dashboard"></i> <span> Dashboard </span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        {{-- <li class="{{ url()->current() == route('agent.referal.all') ? 'active' : '' }}">
          <a href=" {{route ('agent.referal.all') }}">
            <i class="fa fa-group"></i> <span> All My Referrals </span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-danger">   </small>
            </span> -->
          </a>
        </li> --}}



        {{-- <li class="{{ url()->current() == route('agent.notification.all') ? 'active' : '' }}">
          <a href=" {{route ('agent.notification.all') }}">
            <i class="fa fa-bell"></i> <span> General Notice </span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-primary">  </small>
            </span> -->
          </a>
        </li> --}}

        <li class="treeview" style="">
          <a href="#">
            <i class="fa fa-money"></i>
            <span> Requests </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li><a href="{{ route('agent.view.request.blade') }}"><i class="fa fa-circle-o"></i> Make Withdrawal</a></li> -->
            <li><a href="{{ route('logistics_incoming_requests') }}"><i class="fa fa-circle-o"></i> Incoming Requests </a></li>
            <li><a href="{{ route('logistics_requests_in_transit') }}"><i class="fa fa-circle-o"></i> Request in Transit</a></li>
            <li><a href="{{ route('delivered_requests') }}"><i class="fa fa-circle-o"></i> Delivered Requests </a></li>
            <li><a href="{{ route('logistics_payment_history') }}"><i class="fa fa-circle-o"></i> Request History </a></li>

          </ul>
        </li>

        <li class="">
          <a href="{{ route('logistics_profile') }}">
            <i class="fa fa-user"></i> <span> Profile </span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li>
          <a href=" {{ route ('home') }}" target="_blank">
            <i class="fa fa-globe"></i> <span> Vist Website </span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li>
          <a href=" {{ route ('contact') }}" target="_blank">
            <i class="fa fa-question"></i> <span> Help</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
           </form>
           <i class="fa fa-sign-out"></i> <span> Logout </span>
           <span class="pull-right-container">
           </span>
         </a>
       </li>


     </ul>


   </section>
   <!-- /.sidebar -->
   <div class="sidebar-footer">
      <a href=" {{route('seller.message.all') }} " class="link" data-toggle="tooltip" title="" data-original-title="Message"><i class="fa fa-envelope"></i></a>
      <!-- item-->

      <a  href="{{ route('logout') }}" class="link" data-toggle="tooltip" title="" data-original-title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
         @csrf
       </form>
       <i class="fa fa-power-off"></i></a>
  </div>
</aside>

