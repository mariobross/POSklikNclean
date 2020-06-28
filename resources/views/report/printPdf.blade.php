<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Orders</title>
    <style>
        body{
            padding: 0;
            margin: 0;
        }
        .page{
            max-width: 80em;
            margin: 0 auto;
        }
        table th,
        table td{
            text-align: left;
        }
        table.layout{
            width: 100%;
            border-collapse: collapse;
        }
        table.display{
            margin: 1em 0;
        }
        table.display th,
        table.display td{
            border: 1px solid #B3BFAA;
            padding: .5em 1em;
        }
​
        table.display th{ background: #D5E0CC; }
        table.display td{ background: #fff; }
​
        table.responsive-table{
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
        }
​
        .listcust {
            margin: 0;
            padding: 0;
            list-style: none;
            display:table;
            border-spacing: 10px;
            border-collapse: separate;
            list-style-type: none;
        }
​
        .customer {
            padding-left: 50%;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>Point of Sales KliknClean</h3>
        <p><small style="opacity: 0.5;">{{ $order->created_at->format('d-m-Y H:i:s') }}</small></p>
    </div>
    <div class="customer">
        <table>
            <tr>
                <th>Nama Pelanggan</th>
                <td>:</td>
                <td>{{ $order->customer_name }}</td>
            </tr>
            <tr>
                <th>No Telp</th>
                <td>:</td>
                <td>{{ $order->customer_phone }}</td>
            </tr>
        </table>
    </div>
    <div class="page">
        <table class="layout display responsive-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $no = 1;
                    $totalPrice = 0;
                    $totalQty = 0;
                    $total = 0;
                @endphp
                @forelse ($order->order_detail as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->product_name }}</td>
                    <td>Rp {{ number_format($row->product_price) }}</td>
                    <td>{{ $row->product_qty }} Item</td>
                    <td>Rp {{ number_format($row->product_price * $row->product_qty) }}</td>
                </tr>
​
                @php
                    $totalPrice += $row->product_price;
                    $totalQty += $row->product_qty;
                    $total += ($row->product_price * $row->product_qty);
                @endphp
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <td>Rp {{ number_format($totalPrice) }}</td>
                    <td>{{ number_format($totalQty) }} Item</td>
                    <td>Rp {{ number_format($total) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>