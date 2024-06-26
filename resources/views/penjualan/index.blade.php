@extends('layouts.template')
@section('content')
     <div class="card card-outline card-primary">
          <div class="card-header">
               <h3 class="card-title">{{ $page->title }}</h3>
               <div class="card-tools">
                    <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan/create') }}">Tambah</a>
               </div>
          </div>

          @if (session('success'))
               <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if (session('erorr'))
               <div class="alert alert-danger">{{ session('erorr') }}</div>
          @endif

          <div class="row">
               <div class="col-md-12">
                    <div class="form-group row mt-3">
                         <label class="col-1 control-label col-form-label ml-3">Filter:</label>
                         <div class="col-3">
                              <select class="form-control" name="user_id" id="user_id" required>
                                   <option value="">- Semua -</option>
                                   @foreach ($user as $item)
                                        <option value="{{ $item->user_id }}">{{ $item->user_nama }}</option>
                                   @endforeach
                              </select>
                              <small class="form-text text-muted">User Pengelola</small>
                         </div>
                    </div>
               </div>
          </div>

          <div class="card-body">
               <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
                    <thead>
                         <tr>
                         <th>ID</th>
                         <th>Kode Penjualan</th>
                         <th>Pembeli</th>
                         <th>Tanggal Penjualan</th>
                         <th>Nama Pengelola</th>
                         <th>Aksi</th>
                         </tr>
                    </thead>
               </table>
          </div>
     </div>
@endsection

@push('css')
@endpush

@push('js')
     <script>
          $(document).ready(function() {
               var datapenjualan = $('#table_penjualan').DataTable({
                    serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                    ajax: {
                         "url": "{{ url('penjualan/list') }}",
                         "dataType": "json",
                         "type": "POST",
                         "data": function (d) {
                              d.user_id = $('#user_id').val();
                         }
                    },
                    columns: [{
                         data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                         className: "text-center",
                         orderable: false,
                         searchable: false
                    }, {
                         data: "penjualan_kode",
                         className: "",
                         orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                         searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                    }, {
                         data: "pembeli",
                         className: "",
                         orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                         searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                    },
                    {
                         data: "penjualan_tanggal",
                         className: "",
                         orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                         searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                    }, {
                         data: "user.nama",
                         className: "",
                         orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                         searchable: false // searchable: true, jika ingin kolom ini bisa dicari
                    }, {
                         data: "aksi",
                         className: "",
                         orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                         searchable: false // searchable: true, jika ingin kolom ini bisa dicari
                    }]
               });

               $('#user_id').on('change', function() {
                    datapenjualan.ajax.reload();
               });
          });
     </script>
@endpush
