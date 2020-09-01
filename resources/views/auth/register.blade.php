@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign Up</h5>
            <form class="form-signin" method="POST" action="{{ route('register') }}">
                @csrf
              <div class="form-label-group">
                <input id="inputName" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="name" required autocomplete="name" autofocus>
                <label for="inputName">Name</label>
              </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-label-group">
                    <input id="inputEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="email" value="{{ old('email') }}" required autocomplete="email">
                    <label for="inputEmail">Email</label>
                  </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control"b placeholder="new password"  name="password" required autocomplete="new-password">
                <label for="inputPassword">Password</label>
              </div>
              @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-label-group">
                    <input type="password" id="password-confirm" class="form-control" placeholder="confirm password" name="password_confirmation" required autocomplete="new-password">
                    <label for="password-confirm">Confirm Password</label>
                  </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign Up</button>
              <div class="custom-control custom-checkbox mt-3 text-center">
                <p>Already have an account? please <a class="text-info" href="{{route('login')}}">Sign In</a></p>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
