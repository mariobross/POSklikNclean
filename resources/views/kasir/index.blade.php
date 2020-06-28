@extends('layouts/main')

@section('title', 'Data Cashier')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Manajemen Cashier</h4>
        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
      </div>
      <div class="card-body">
        <a href="{{url('cashier/create')}}" 
            class="btn btn-primary btn-sm">
            <i class="fa fa-edit"></i> Add
        </a>
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Address</th>
              <th>Action</th>
            </thead>
            <tbody>
              @foreach($cashier as $csh)
              <tr>
                <td>
                  {{$csh->name}}
                </td>
                <td>
                  {{$csh->username}}
                </td>
                <td>
                  {{$csh->email}}
                </td>
                <td>
                  {{$csh->phone}}
                </td>
                <td style="width: 25%;">
                  {{$csh->address}}
                </td>
                <td>
                <a href="{{url('cashier/'.$csh->id.'/edit')}}" class="btn btn-success">Edit</a>
                  <form action="{{ url('cashier/'.$csh->id) }}" class="d-inline" method="post">
                    @method('delete')
                    @csrf

                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-12">
        {{ $cashier->links() }}
      </div>
    </div>
  </div>
</div>
@endsection