@extends('admin.admin-master')

@section('admin_content')

<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
      <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">starlight <span class="tx-info tx-normal">admin</span></div>
      <div class="tx-center mg-b-50"></div>

      <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="form-group">
              <input type="email" id="email" name="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Enter your username" required autocomplete="email" autofocus>
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div><!-- form-group -->
          <div class="form-group">
              <input type="password" id="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Enter your password" required autocomplete="current-password">
              
              {{-- <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a> --}}
              @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror

              @if (Route::has('password.request'))
                <a class="tx-info tx-12 d-block mg-t-10" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
              @endif
          </div><!-- form-group -->
          <button type="submit" class="btn btn-info btn-block">Sign In</button>
      </form>

      
    </div><!-- login-wrapper -->
  </div><!-- d-flex -->


@endsection