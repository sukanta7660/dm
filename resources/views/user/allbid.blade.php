@extends('layouts.master')
@section('title')
    BID Products
@endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{asset('public/user_asset/images/bg_6.jpg')}});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="#">Home</a></span> <span>Bid</span></p>
                    <h1 class="mb-0 bread">Bid Products</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-10 order-md-last col-sm-12">
                    <div class="row" id="">
                        @foreach ($table as $item)
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="product">
                                <a href="#" class="img-prod"><img value="2" class="img-fluid" src="{{ck_file('products', 'public/uploads/products',$item->imageName)}}" alt="product image">
                                    <span class="status">
                                    @if ($item->bidStatus == 'ON')
                                        Running
                                    @else
                                        Completed
                                    @endif
                                </span>
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 px-3">
                                    <h3><a value="2" href="#">{{$item->name}}</a></h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price"><span class="price-sale" value="2">{{money($item->price)}}</span></p>
                                        </div>
                                        <div class="rating">

                                        </div>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <a style="border-radius: 0; margin-top:10px;" href="{{action('User\ProductController@single_bid',['id' => $item->productID])}}" class="btn btn-info btn-md">Place a Bid</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">

    </script>
@endsection
