@extends('layouts/main')

@section('title', 'Data Product')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Manajemen Product</h4>
      </div>
      <div class="card-body">
        <form action="/product/{{$product->id}}" method="post">
          @method('patch')
          @csrf
          <div class="form-group">
            <label for="name">Product name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  placeholder="Enter product name" value="{{$product->name}}">
            @error('name')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price"  placeholder="Enter price" value="{{$product->price}}">
            @error('price')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror

          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter description" value="{{$product->description}}">
            @error('description')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection