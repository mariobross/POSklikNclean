@extends('layouts/main')

@section('title', 'Data Product')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Manajemen Product</h4>
        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
      </div>
      <div class="card-body">
        <a href="{{url('product/create')}}" 
            class="btn btn-primary btn-sm">
            <i class="fa fa-edit"></i> Add
        </a>
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <th>Name</th>
              <th>Price</th>
              <th>Description</th>
              <th>Action</th>
            </thead>
            <tbody>
              @foreach($product as $prd)
              <tr>
                <td>
                  {{ $prd->name }}
                </td>
                <td>
                  Rp {{ number_format($prd->price) }}
                </td>
                <td style="width:35%">
                  {{ $prd->description }}
                </td>
                <td>
                  <a href="{{url('product/'.$prd->id.'/edit')}}" class="btn btn-success">Edit</a>
                  <form action="{{ url('product/'.$prd->id) }}" class="d-inline" method="post">
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
        {{ $product->links() }}
      </div>
      
    </div>
  </div>
</div>
@endsection