<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;

class ReportController extends Controller
{

    public function index(Request $request){
        $orders = Order::orderBy('created_at','DESC')->with('order_detail');

        if (!empty($request->start_date) && !empty($request->end_date)) {
            
            $this->validate($request, [
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date'
            ]);
            
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01';
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59';
    
     
            $orders = $orders->whereBetween('created_at', [$start_date, $end_date])->paginate(5);
        } else {
            $orders = $orders->paginate(5);
        }

        return view('report.index',compact('orders'));
    }

    public function printPdf($id){
        $order = Order::where('id', $id)
                    ->with('order_detail')->first();
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
                    ->loadView('report.printPdf', compact('order'));
        return $pdf->stream();
    }
}
