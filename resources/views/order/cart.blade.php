<div class="col-md-4">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title"> Chart</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" >
          <thead>
              <tr>
                  <th>Produk</th>
                  <th>Harga</th>
                  <th>Qty</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="(row, index) in shoppingCart">
                  <td>@{{ row.name }}</td>
                  <td>@{{ row.price | currency }}</td>
                  <td>@{{ row.qty }}</td>
                  <td>
                      <button 
                          @click.prevent="removeCart(index)"    
                          class="btn btn-danger btn-sm">
                          <i class="fa fa-trash"></i>
                      </button>
                  </td>
              </tr>
          </tbody>
        </table>
        <div class="card-footer text-muted">
          @if (url()->current() == route('order.order'))
            <a href="{{ route('order.checkout') }}" 
                class="btn btn-info btn-sm float-right">
                Checkout
            </a>
          @else
            <a href="{{ route('order.order') }}"
                class="btn btn-secondary btn-sm float-right"
                >
                Kembali
            </a>
          @endif
        </div>
          </div>
        </div>
    </div>
  </div>