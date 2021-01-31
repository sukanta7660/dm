@extends('layouts.master')
@section('title')
    Appointment
@endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{asset('public/user_asset/images/bg_6.jpg')}});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="#">Home</a></span> <span>Doctors</span></p>
                    <h1 class="mb-0 bread">Appointment</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section contact-section bg-light">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="w-100"></div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <h2>Doctor Info</h2>
                        <img src="{{asset('public/uploads/doctor/'.$table->imageName)}}" alt="doctor image" style="max-width: 100%;border: 2px solid #ccc;padding: 6px;">
                        <h5><span>Name: </span> {{$table->name}}</h5>
                        <p><span>Chamber: </span> {{$table->chamberDetails}}</p>
                        <p><span>Check Fee: </span> {{money($table->checkFee)}}</p>
                        <p><span>Time: </span> {{$table->time}}</p>

                        <p class="{{$table->isVisible==1 ? 'bg-success' : 'bg-danger'}} text-white text-center"><span>{{$table->isVisible ? 'Available' : 'Not Available'}}</p>
                </div>
                </div>
                <div class="col-md-9 order-md-last d-flex">
                    <form action="{{action('User\DoctorController@get_appointment')}}" method="POST" class="bg-white p-5 contact-form">
                        @csrf
                        <input type="hidden" name="doctor_id" value="{{$table->id}}">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <h2>Get Your Appointment</h2>
                        @if ($table->isVisible==1)
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Patient Name">
                        </div>
                        <div class="form-group">
                            <input type="number" name="patient_Age" class="form-control" placeholder="Patient Age Ex: 24">
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" class="form-control" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <input type="text" name="number" class="form-control" placeholder="Contact Number Example: 01733251458">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit Appointment</button>
                        </div>
                        @else
                        <h3 class="text-warning text-center">Not Available for this time</h3>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection