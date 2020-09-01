@extends('layouts.master')
@section('title')
    Product
@endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{asset('public/user_asset/images/bg_6.jpg')}});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="#">Home</a></span> <span>Products</span></p>
                    <h1 class="mb-0 bread">Collection Products</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-2 sidebar col-sm-12">
                    <div class="sidebar-box-2">
                        <h2 class="heading mb-4"><a href="#">Categories</a></h2>
                        <ul id="categoryClick">
                            @foreach($category as $row)
                            <li style="text-decoration: underline;"><a href="{{action('User\ProductController@cat_wise_product',['id' => $row->categoryID])}}">{{$row->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 col-lg-10 order-md-last col-sm-12">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <form action="">
                                        <input id="searchItem" class="form-control" type="text" data-url="{{action('User\ProductController@itemSearch')}}" name="search" placeholder="Search Here">
                                </form>
                            </div>
                        </div>
                    <div class="row" id="productLoad">

                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
                $(function () {
                    contents("{{action('User\ProductController@all_product')}}");
                    $('#categoryClick li a').click(function (e) {
                        e.preventDefault();
                        var url = $(this).attr('href');
                        contents(url);

                    });
                    $('#searchItem').keyup(function (e) {
                e.preventDefault();
                var search = $(this).val();
                var url = $(this).data('url')+'?search='+search;

                if (search.length>0){
                    contents(url);
                }
                else {
                    contents("{{action('User\ProductController@all_product')}}");
                }

            });

         });
                function contents(url) {
                    $.get(url, function(result){
                        var showData = '';
                        $.each(result, function( i, row ) {

                            showData += '<div class="col-sm-12 col-md-4 col-lg-4">\n' +
                                '                                <div class="product">\n' +
                                '                                    <a href="{{url('product/details')}}/'+row.productID+'" class="img-prod"><img value="'+row.productID+'" class="img-fluid" src="public/uploads/products/'+row.imageName+'" alt="product image">\n' +
                                '                                        \n' +
                                '                                        <div class="overlay"></div>\n' +
                                '                                    </a>\n' +
                                '                                    <div class="text py-3 px-3">\n' +
                                '                                        <h3><a value="'+row.productID+'" href="#">'+row.name+'</a></h3>\n' +
                                '                                        <div class="d-flex">\n' +
                                '                                            <div class="pricing">\n' +
                                '                                                <p class="price"><span class="price-sale" value="'+row.productID+'">'+row.productGroup+'</span></p>\n' +
                                '                                            </div>\n' +
                                '                                            <div class="rating">\n' +
                                '                                                 <p>'+row.price1+' (unit price)</p>\n'+
                                '                                            </div>\n' +
                                '                                        </div>\n' +
                                '                                        <div style="margin-left: 44px;" class="btn-group" role="group" aria-label="...">\n' +
                                '                                            <button  class="btn btn-secondary text-bold cart_minus" value="'+row.productID+'" style="border-radius: 2px;" type="button" data-id="'+row.productID+'" data-price="'+row.price+'">-</button>\n' +
                                '                                            <button  type="button" data-id="'+row.productID+'" data-price="'+row.price+'" class="btn btn-info text-grey-400 show_cart"><i class="icon-cart5"></i> <span>Add to cart</span></button>\n' +
                                '                                            <button class="btn btn-primary text-bold cart_plus" type="button" data-id="'+row.productID+'" data-price="'+row.price+'" >+</button>\n' +
                                '                                            <input class="cart_val" type="hidden" value="0" autocomplete="off">\n' +
                                '                                        </div>\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '                            </div>'
                        });

                        $('#productLoad').html(showData);
                        cart();
                    });



                }


                function cart(){

                    $('.cart_plus').click(function(){
                        var id = $(this).data('id');
                        var price = $(this).data('price');
                        add_cart(id, price);
                    });

                    $('.show_cart').click(function(){
                        var id = $(this).data('id');
                        var price = $(this).data('price');
                        show_cart(id, price);
                    });

                    $('.cart_minus').click(function(){
                        var id = $(this).data('id');
                        var price = $(this).data('price');
                        remove_cart(id, price);
                    });
                }

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
@endsection
