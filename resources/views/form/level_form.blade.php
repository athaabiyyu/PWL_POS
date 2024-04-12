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
               <form id="quickForm">
               <div class="card-body">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Kode Level</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Kode Level">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Nama Level</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Level">
                    </div>
                    <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                    <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
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
