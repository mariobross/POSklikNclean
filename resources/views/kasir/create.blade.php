@extends('layouts/main')

@section('title', 'Data Cashier')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Manajemen Cashier</h4>
      </div>
      <div class="card-body">
        <form action="/cashier" method="post">
        @csrf
          <div class="form-group">
            <label for="name">Full name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  placeholder="Enter Name" value="{{old('name')}}">
            @error('name')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"  placeholder="Enter phone number" value="{{old('phone')}}">
            @error('phone')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter address" value="{{old('address')}}">
            @error('address')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{old('email')}}">
            @error('email')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"  placeholder="Enter username" value="{{old('username')}}">
            @error('username')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" value="{{old('password')}}">
            @error('password')
              <div class="invalid-feedback">
                {{$message}}
              </div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection