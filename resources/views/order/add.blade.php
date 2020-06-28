@extends('layouts/main')

@section('title', 'Data Order')

@section('content')
<section class="content" id="od">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Manajemen Order</h4>
          </div>
          <div class="card-body d-flex ">
            <div class="col-md-4">
              <form action="#" @submit.prevent="addToCart" method="post">
                <div class="form-group">
                    <label for="">Produk</label>
                    <select id="product_id" name="product_id" 
                        v-model="cart.product_id"
                        class="form-control" width="100%">
                        <option value="">Pilih</option>
                        @foreach ($product as $prod)
                        <option value="{{ $prod->id }}"> {{ $prod->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Qty</label>
                    <input type="number" name="qty"
                        v-model="cart.qty" 
                        id="qty" value="1" 
                        min="1" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm"
                        :disabled="submitCart"
                        >
                        <i class="fa fa-shopping-cart"></i> @{{ submitCart ? 'Loading...':'Ke Keranjang' }}
                    </button>
                </div>
              </form>
            </div>
            <div class="col-md-5">
              <h4>Product Detail</h4>
              <div v-if="product.name">
                  <table class="table table-stripped">
                      
                      <tr>
                          <th width="3%">Product</th>
                          <td width="2%">:</td>
                          <td>@{{ product.name }}</td>
                      </tr>
                      <tr>
                          <th>Price</th>
                          <td>:</td>
                          <td>@{{ product.price | currency }}</td>
                      </tr>
                      <tr>
                          <th>Description</th>
                          <td>:</td>
                          <td>@{{ product.description }}</td>
                      </tr>
                  </table>
              </div>
          </div>
              </div>
          </div>
        </div>
        @include('order.cart')
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
  <script src="{{ asset('js/accounting.min.js') }}"></script>
  <script src="{{ asset('js/order.js') }}"></script>
@endsection