@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Create')

@section('content')
     <div class="container">
          <div class="card card-primary">
               <div class="card-header">
                    <h3 class="card-title">Buat Kategori Baru</h3>
               </div>
          </div>

          <form method="post" action="../kategori">
               <div class="card-body">
                    <div class="form-group">
                         <label for="kodeKategori">Kode Kategori</label>
                         <input type="text" class="form-control" id="kodeKategori" name="kodeKategori" placeholder="Masukkan Kode Kategori">
                    </div>
                    <div class="form-group">
                         <label for="namaKategori">Nama Kategori</label>
                         <input type="text" class="form-control" id="namaKategori" name="namaKategori" placeholder="Masukkan Nama Kategori">
                    </div>
               </div>

               <div class="card-footer">
                    <button type="submit" class="btn-primary">Submit</button>
               </div>
          </form>
     </div>
@endsection
