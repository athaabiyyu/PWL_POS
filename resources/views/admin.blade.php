@extends('layouts.app')

@section('subtitile', 'Admin')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Tampilan <?= (Auth::user()->level_id == 1)?'Admin':'Manager'; ?>
                <div class="card-body">
                    <h1>Login Sebagai:
                        <?= (Auth::user()->level_id == 1)?'Admin':'Manager'; ?>
                    </h1>
                    <a href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush

@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
     <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php
     $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login');
     $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register');
     $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset');
     if (config('adminlte.use_route_url', false)) {
          $login_url = $login_url ? route($login_url) : '';
          $register_url = $register_url ? route($register_url) : '';
          $password_reset_url = $password_reset_url ? route($password_reset_url) : '';
     } else {
          $login_url = $login_url ? url($login_url) : '';
          $register_url = $register_url ? url($register_url) : '';
          $password_reset_url = $password_reset_url ? url($password_reset_url) : '';
     }
@endphp

@section('auth_header', __('adminlte::adminlte.login_message'))

@section('auth_body')
     @error('login_gagal')
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
               <span class="aler-inner--text"><strong>Warning!</strong> {{ $message }}</span>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
               </button>
          </div>
     @enderror

     <form action="{{ url('proses_login') }}" method="post">
          @csrf

          {{-- Email field --}}
          <div class="input-group mb-3">
               <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                    value="{{ old('username') }}" placeholder="Username" autofocus>
               <div class="input-group-append">
                    <div class="input-group-text">
                         <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
               </div>

               @error('username')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
               @enderror
          </div>

          {{-- Password field --}}
          <div class="input-group mb-3">
               <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="{{ __('adminlte::adminlte.password') }}">
               <div class="input-group-append">
                    <div class="input-group-text">
                         <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
               </div>

               @error('password')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
               @enderror
          </div>

          {{-- Login field --}}
          <div class="row">
               <div class="col-7">
                    <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                         <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                         <label for="remember">
                         {{ __('adminlte::adminlte.remember_me') }}
                         </label>
                    </div>
               </div>

               <div class="col-5">
                    <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                         <span class="fas fa-sign-in-alt"></span>
                         {{ __('adminlte::adminlte.sign_in') }}
                    </button>
               </div>
          </div>
     </form>
@stop

@section('auth_footer')
     @if ($register_url)
          <p class="my-0">
               <a href="{{ route('register') }}">
                    {{ __('adminlte::adminlte.register_a_new_membership') }}
               </a>
          </p>
     @endif
@stop