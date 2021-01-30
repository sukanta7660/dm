@extends('layouts.master')
@section('title')
    Doctors
@endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{asset('public/user_asset/images/bg_6.jpg')}});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="#">Home</a></span> <span>Doctors</span></p>
                    <h1 class="mb-0 bread">Doctors</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section bg-light custom-border-bottom pb-5 pt-5" data-aos="fade">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-lg-2 sidebar col-sm-12">
              <div class="sidebar-box-2">
                  <h2 class="heading mb-4 text-success"><a href="#">Departments</a></h2>
                  <ul id="categoryClick">
                  
                      @foreach ($depts as $item)
                      <li style="text-decoration: underline;"><a href="{{action('User\DoctorController@department_wise',['id' => $item->id, 'slug' => $item->slug])}}">{{$item->dept_Name}}</a></li>
                      @endforeach
                  </ul>
              </div>
          </div>
          <div class="col-md-8 col-lg-10 order-md-last col-sm-12">
        <div class="row" id="productLoad">
          @foreach ($table as $item)
          <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="product">
                <a href="#" class="img-prod">
                  <img value="1" class="img-fluid" height="100" src="{{asset('public/uploads/doctor/'.$item->imageName)}}" alt="product image">
                    
                    <div class="overlay"></div>
                </a>
                <div class="text py-3 px-3">
                    <h3><a value="1" href="#">{{$item->name}}</a></h3>
                    <div class="d-flex">
                        <div class="pricing">
                            <p class="price"><span class="price-sale">{{$item->time}}</span></p>
                            <p class="price">Time: <span class="text-primary">{{$item->chamberDetails}}</span></p>
                        </div>
                    </div>
                    <a href="{{action('User\DoctorController@appointment_page',['id' => $item->id, 'slug' => str_slug($item->name)])}}" class="btn btn-primary btn-sm"> Make Appointment</a>
                </div>
            </div>
        </div>
          @endforeach
              </div>
    </div>
          </div>
        </div>
      </div>

      
@endsection
