@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Edit')

@section('content')

     <div class="container">
          <div class="card card-primary">
               <div class="card-header">
                    <h3 class="card-title">Edit Kategori</h3>
               </div>
          </div>

          <form method="post" action="/kategori/edit/{{ $kategori->kategori_kode }}">

               @csrf
               @method('PUT')

               <div class="card-body">
                   <div class="form-group">
                       <label for="kodeKategori">Kode Kategori</label>
                       <input type="text" class="form-control" id="kodeKategori" name="kodeKategori" value="{{ $kategori->kategori_kode }}">
                   </div>
                   <div class="form-group">
                       <label for="namaKategori">Nama Kategori</label>
                       <input type="text" class="form-control" id="namaKategori" name="namaKategori" value="{{ $kategori->kategori_nama }}">
                   </div>
               </div>
           
               <div class="card-footer">
                   <button type="submit" class="btn-primary">Change</button>
               </div>
           </form>
           
     </div>
@endsection
