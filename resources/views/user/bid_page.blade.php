@extends('layouts.master')
@section('title')
    {{$table->name}}
@endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{asset('public/user_asset/images/bg_6.jpg')}});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="#">Home</a></span> <span class="mr-2"><a href="#">Bid</a></span> <span>Bid</span></p>
                    <h1 class="mb-0 bread">Bid Products</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
    				<a href="{{ck_file('products', 'public/uploads/products',$table->imageName)}}" class="image-popup"><img src="{{ck_file('products', 'public/uploads/products',$table->imageName)}}" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3>{{$table->name}}</h3>
    				<p class="price"><span>{{money($table->price)}}</span></p>
    				<p>{{$table->specification}}</p>
    				<p>{{$table->description}}</p>

              @if ($table->bidStatus=='ON')
              <form action="{{action('User\ProductController@bid_save')}}" method="post" enctype="multipart/form-data">
                @csrf
              <input type="hidden" name="userID" value="{{Auth::user()->id}}">
              <input type="hidden" name="productID" value="{{$table->productID}}">
                <div class="row mt-4">
                    <div class="w-100"></div>
                    <div class="input-group col-md-6 d-flex mb-3">

                        <input type="number" id="quantity" name="price" class="form-control input-number" value="0" min="0" >
                        <span class="input-group-btn ml-2">
                           <button type="submit" class="btn btn-default" data-type="plus" data-field="">
                            Place a Bid
                        </button>
                        </span>
                     </div>
          <div class="w-100"></div>
      </div>
              </form>
              @else
                <h3 class="text-danger">Bid has been Completed</h3>
              @endif
    			</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-body">
                        <h2>All Biders</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Bidder</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                    @foreach($bider as $row)
                                            <tr class="text-center">
                                                <td class="image-prod">{{$i++}}</td>
                                                <td class="product-name">{{$row->customer['name']}}</td>
                                                <td class="">{{money($row->price)}}</td>
                                                <td class="quantity">{{$row->created_at->format('F d,Y h:i:s A')}}</td>
                                            </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                                {{$bider->links()}}
                            </div>
                        </div>
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
