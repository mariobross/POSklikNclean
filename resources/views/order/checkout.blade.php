@extends('layouts/main')

@section('title', 'Data Order')

@section('content')
<section class="content" id="od">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Data Pelanggan</h4>
          </div>
          <div class="card-body">
              <div class="form-group">
                  <label for="">Nama Pelanggan</label>
                  <input type="text" name="name" 
                      v-model="customer.name"
                      class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="">No Telp</label>
                  <input type="text" name="phone" 
                      v-model="customer.phone"
                      class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="">Alamat</label>
                  <textarea name="address"
                      class="form-control"
                      v-model="customer.address"
                      cols="5" rows="5" required></textarea>
              </div>
          </div>
            <div class="card-footer text-muted ">
              <div v-if="errorMessage" class="alert alert-danger">
                  @{{ errorMessage }}
              </div>
              <button class="btn btn-primary btn-sm float-right mb-3"
                  :disabled="submitForm"  
                  @click.prevent="sendOrder"
                  >
                  @{{ submitForm ? 'Loading...':'Order Now' }}
              </button>
            </div>
          </div>
            
          </div>
          @include('order.cart')
        </div>
        
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
  <script src="{{ asset('js/accounting.min.js') }}"></script>
  <script src="{{ asset('js/order.js') }}"></script>
@endsection