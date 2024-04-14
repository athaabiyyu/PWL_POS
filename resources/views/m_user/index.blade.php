@extends('m_user/template')
@section('content')
     <div class="row mt-5 mb-5">
          <div class="col-lg-12 margin-tb">
               <div class="float-left">
                    <h2>CRUD user</h2>
               </div>
               <div class="float-right">
                    <a class="btn btn-success" href="{{ route('m_user.create') }}"> Input User</a>
               </div>
          </div>
     </div>

     @if ($message = Session::get('success'))
          <div class="alert alert-success">
               <p>{{ $message }}</p>
          </div>
     @endif

     <div class="table-responsive-md">
          <table class="table table-bordered table-striped">
               <tr>
                    <th style="width: 2%" class="text-center">User id</th>
                    <th style="width: 2%" class="text-center">Level ID</th>
                    <th style="width: 10%" class="text-center">Username</th>
                    <th style="width: 10%" class="text-center">Nama</th>
                    <th style="width: 10%" class="text-center">Password</th>
                    <th style="width: 10%" class="text-center">Action</th>
               </tr>
               @foreach ($useri as $m_user)
                    <tr>
                         <td>{{ $m_user->user_id }}</td>
                         <td>{{ $m_user->level->level_id }}</td>
                         <td>{{ $m_user->username }}</td>
                         <td>{{ $m_user->nama }}</td>
                         <td>{{ substr_replace($m_user->password, '...', 5, strlen($m_user->password) - 10) }}</td>
                         <td class="text-center">
                         <form action="{{ route('m_user.destroy', $m_user->user_id) }}" method="POST">
                              <a class="btn btn-info btn-sm" href="{{ route('m_user.show', $m_user->user_id) }}">Show</a>
                              <a class="btn btn-primary btn-sm" href="{{ route('m_user.edit', $m_user->user_id) }}">Edit</a>
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                         </form>
                         </td>
                    </tr>
               @endforeach
          </table>
     </div>
@endsection
