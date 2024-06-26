@extends('layouts.template')
@section('content')
     <div class="card card-outline card-primary">
          <div class="card-header">
               <h3 class="card-title">{{ $page->title }}</h3>
               <div class="card-tools">
                    <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah</a>
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
                              <select class="form-control" name="barang_id" id="barang_id" required>
                                   <option value="">- Semua -</option>
                                   @foreach ($barang as $item)
                                        <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                   @endforeach
                              </select>
                              <small class="form-text text-muted">Barang</small>
                         </div>
                    </div>
               </div>
          </div>

          <div class="card-body">
               <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
                    <thead>
                         <tr>
                         <th>ID</th>
                         <th>Tanggal Stok</th>
                         <th>Jumlah Stok</th>
                         <th>Nama Barang</th>
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
               var datastok = $('#table_stok').DataTable({
                    serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                    ajax: {
                         "url": "{{ url('stok/list') }}",
                         "dataType": "json",
                         "type": "POST",
                         "data": function (d) {
                              d.barang_id = $('#barang_id').val();
                         }
                    },
                    columns: [{
                         data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                         className: "text-center",
                         orderable: false,
                         searchable: false
                    }, {
                         data: "stok_tanggal",
                         className: "",
                         orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                         searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                    }, {
                         data: "stok_jumlah",
                         className: "",
                         orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                         searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                    }, {
                         data: "barang.barang_nama",
                         className: "",
                         orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                         searchable: false // searchable: true, jika ingin kolom ini bisa dicari
                    },
                    {
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

               $('#barang_id').on('change', function() {
                    datastok.ajax.reload();
               });
          });
     </script>
@endpush
