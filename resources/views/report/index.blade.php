@extends('layouts/main')

@section('title', 'Data Report')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Manajemen Report</h4>
      </div>
      <div class="card-body">
      <form action="{{ url('/report') }}" method="get">
        <div class="row">
          
            <div class="col-md-6">
              <div class="form-group">
                  <label for="">Start Tanggal</label>
                  <input type="text" name="start_date" 
                      class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}"
                      id="start_date"
                      value="{{ request()->get('start_date') }}"
                      >
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">End Tanggal</label>
                    <input type="text" name="end_date" 
                        class="form-control {{ $errors->has('end_date') ? 'is-invalid':'' }}"
                        id="end_date"
                        value="{{ request()->get('end_date') }}">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-sm ml-3">Search</button>
            </div>
          
        </div>
        </form>
      </div>      
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">List Report Order</h4>
      </div>
      <div class="card-body">
      <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <th>Pelanggan</th>
              <th>No Telp</th>
              <th>Total Belanja</th>
              <th>Tgl Transaksi</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              @forelse($orders as $row)
              <tr>
                <td>{{ $row->customer_name }}</td>
                <td>{{ $row->customer_phone }}</td>
                <td>{{ number_format($row->total) }}</td>
                <td>{{ $row->created_at->format('d-m-Y H:i:s') }}</td>
                <td>
                  <a href="{{url('report/pdf/'.$row->id)}}" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
                </td>
              </tr>
              @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          {{ $orders->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
    <script>
        $('#start_date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });

        $('#end_date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection