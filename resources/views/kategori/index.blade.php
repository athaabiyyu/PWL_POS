@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
     <div class="container">
          <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Manage Kategori</span>
                    <span class="ml-auto"><a href="/kategori/create" class="btn btn-sm btn-primary">+ Add Category</a></span>
               </div>
               
               <div class="card-body">
                    {{ $dataTable->table() }}
               </div>
          </div>
     </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
