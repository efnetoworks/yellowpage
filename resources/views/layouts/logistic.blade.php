
<!DOCTYPE html>
<html lang="en">
<meta name="_token" content="{{csrf_token()}}"/>



@include('layouts.logistics_partials.header')

<body class="skin-blue sidebar-mini wysihtml5-supported" style="height: auto; min-height: 100%;">

	@include('layouts.logistics_partials.nav')
	@include('layouts.logistics_partials.sidebar')

	@yield('content')

	@include('layouts.logistics_partials.footer')
    @include('layouts.logistics_partials.js')

</body>

</html>
