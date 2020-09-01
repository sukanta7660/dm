<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title') || {{config('sp.company')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('public/user_asset/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/user_asset/css/animate.css')}}">

  <link rel="stylesheet" href="{{asset('public/user_asset/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/user_asset/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/user_asset/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('public/user_asset/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('public/user_asset/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/user_asset/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('public/user_asset/css/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('public/user_asset/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('public/user_asset/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('public/user_asset/css/style.css')}}">
	  @yield('style')
  </head>
  <body class="goto-here">
		<!-- Header -->
		@include('shared.user.header')
    	<!-- Header -->

		<!-- Content -->
		@yield('content')
		<!-- Content -->
        @include('sweet::alert')
		<!-- Footer -->
		@include('shared.user.footer')
		<!-- Footer -->

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{asset('public/user_asset/js/jquery.min.js')}}"></script>
  <script src="{{asset('public/user_asset/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('public/user_asset/js/popper.min.js')}}"></script>
  <script src="{{asset('public/user_asset/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('public/user_asset/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('public/user_asset/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('public/user_asset/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('public/user_asset/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('public/user_asset/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('public/user_asset/js/aos.js')}}"></script>
  <script src="{{asset('public/user_asset/js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{asset('public/user_asset/js/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('public/user_asset/js/scrollax.min.js')}}"></script>
  <script src="{{asset('public/user_asset/js/main.js')}}"></script>
  @yield('script')
<script type="text/javascript">
//############################# COOKIE GENERATE #############################

@if (!Session::has('unique_session'))

$(function () {
    $.get( "{{action('User\IndexController@gen_session')}}" );
});
@endif
//#####################################################################################


function add_cart(id, price) {
            $.ajax({
                url: "{{action('User\ProductCartController@add_cart')}}",
                type: 'GET',
                data: {productID:id, price:price},
                success:function(result){

                    console.log(result);
                    showcartintop();

                  //  temp_count();

                },
                error: function (jXHR, textStatus, errorThrown) {html("")}
            });
        }

        function show_cart(id, price) {
            $.ajax({
                url: "{{action('User\ProductCartController@show_cart')}}",
                type: 'GET',
                data: {productID:id, price:price},
                success:function(result){

                    console.log(result);
                    showcartintop();

                },
                error: function (jXHR, textStatus, errorThrown) {html("")}
            });
        }

        function remove_cart(id) {
            $.ajax({
                url: "{{action('User\ProductCartController@remove_cart')}}",
                type: 'GET',
                data: {productID:id},
                success:function(result){



                    console.log(result);
                    showcartintop();
                   // temp_count();

                },
                error: function (jXHR, textStatus, errorThrown) {html("")}
            });
        }

        function showcartintop(){
            $.ajax({
                url : "{{action('User\ProductCartController@get_temp_order')}}",
                type : 'GET',
                success : function(data){
                    if(data > 0){
                        $('#cart_item').html('[ '+data+' ]');
                    }

                }
            });
        }
        showcartintop();
</script>
  </body>
</html>
