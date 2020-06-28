<?php

namespace App\Http\Controllers;


use App\Product;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class OrdersController extends Controller
{
    public function addOrder(){
        $product = Product::all();
        return view('order.add', compact('product'));
    }

    public function getProduct($id){
        $products = Product::findOrFail($id);
        return response()->json($products, 200);
    }

    public function addToCart(Request $request){
        // return $request;
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ]);
        
        $product = Product::findOrFail($request->product_id);
        $getCart = json_decode($request->cookie('cart'), true);
        
        if ($getCart) {
            if (array_key_exists($request->product_id, $getCart)) {
                $getCart[$request->product_id]['qty'] += $request->qty;
                return response()->json($getCart, 200)
                    ->cookie('cart', json_encode($getCart), 120);
            } 
        }

        $getCart[$request->product_id] = [
            'name' => $product->name,
            'price' => $product->price,
            'qty' => $request->qty,
            'description' => $product->description
        ];
        return response()->json($getCart, 200)
            ->cookie('cart', json_encode($getCart), 120);
    }

    public function getCart(){
        $cart = json_decode(request()->cookie('cart'), true);
        return response()->json($cart, 200);
    }

    public function removeCart($id){
        $cart = json_decode(request()->cookie('cart'), true);
        unset($cart[$id]);
        return response()->json($cart, 200)->cookie('cart', json_encode($cart), 120);
    }

    public function checkout(){
        return view('order.checkout');
    }

    public function storeOrder(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'address' => 'required',
            'phone' => 'required|numeric'
        ]);

        $cart = json_decode($request->cookie('cart'), true);

        
        $result = collect($cart)->map(function($value) {
            return [
                'name' => $value['name'],
                'qty' => $value['qty'],
                'price' => $value['price'],
                'description' => $value['description'],
                'result' => $value['price'] * $value['qty']
            ];
        })->all();

        DB::beginTransaction();
            try{
                $order = Order::create([
                    'customer_name' => $request->name,
                    'customer_phone' => $request->phone,
                    'total' => array_sum(array_column($result, 'result'))
                ]);

                foreach ($result as $key => $row) {
                    $order->order_detail()->create([
                        'product_description' => $row['description'],
                        'product_name' => $row['name'],
                        'product_qty' => $row['qty'],
                        'product_price' => $row['price']
                    ]);
                }
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Congratulations',
                ], 200)->cookie(Cookie::forget('cart'));

            }catch(\Exception $e){
                DB::rollback();
                return response()->json([
                    'status' => 'failed',
                    'message' => $e->getMessage()
                ], 400);
            }
        
    }
}
