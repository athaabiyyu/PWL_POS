@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
     <div class="container-fluid">
          <div class="row">
               <!-- left column -->
               <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                         <div class="card-header">
                         <h3 class="card-title">Form <small>User</small></h3>
                         </div>
                         <!-- /.card-header -->

                         <!-- form start -->
                         @if ($errors->any())
                         <div class="alert alert-danger">
                              <ul>
                                   @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                   @endforeach
                              </ul>
                         </div>
                         @endif

                         <form id="quickForm" method="post" action="../user/tambah_simpan">
                              @csrf
                         <div class="card-body">
                              <div class="form-group">
                                   <label for="username_user">Username</label>
                                   <input type="text" name="username" class="form-control" id="username"
                                        placeholder="Masukkan Username">
                              </div>
                              <div class="form-group">
                                   <label for="nama_user">Nama</label>
                                   <input type="text" name="nama" class="form-control" id="nama_user"
                                        placeholder="Masukkan Nama">
                              </div>
                              <div class="form-group">
                                   <label for="exampleInputPassword1">Password</label>
                                   <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Masukkan Password">
                              </div>
                              <div class="form-group">
                                   <label for="level_user">Level</label>
                                   <input type="text" name="level_id" class="form-control" id="level_user"
                                        placeholder="Masukkan Level">
                              </div>
                              <div class="form-group mb-0">
                                   <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                        <label class="custom-control-label" for="exampleCheck1">I agree to the <a
                                             href="#">terms of service</a>.</label>
                                   </div>
                              </div>
                         </div>
                         <!-- /.card-body -->
                         <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                         </div>
                         </form>
                    </div>
                    <!-- /.card -->
               </div>
               <!--/.col (left) -->
               <!-- right column -->
               <div class="col-md-6">

               </div>
               <!--/.col (right) -->
          </div>
          <!-- /.row -->
     </div><!-- /.container-fluid -->
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
