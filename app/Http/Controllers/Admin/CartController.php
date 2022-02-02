<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ProductList;
use App\Models\CartOrder;
use Carbon\Carbon;


class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $email = $request->input('user_email');
        $size = $request->input('product_size');
        $color = $request->input('color');
        $quantity = $request->input('quantity');
        $product_code = $request->input('product_code');

        $product = ProductList::where('product_code', $product_code)->first();
        $price = $product->price;
        $special_price = $product->offer_price;

        if ($special_price == "na") {
            $total_price = $price * $quantity;
            $unit_price = $price;
        } else {
            $total_price = $special_price * $quantity;
            $unit_price = $special_price;
        }

        $result = Cart::insert([
            'user_email' => $email,
            'product_size' => $size,
            'color' => $color,
            'quantity' => $quantity,
            'product_code' => $product_code,
            'total_price' => $total_price,
            'unit_price' => $unit_price,
            'product_image' => $product->product_image,
            'product_name' => $product->title,
        ]);

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function countCart(Request $request)
    {
        $user_email = $request->user_email;
        $result = Cart::where('user_email', $user_email)->count();
        return response()->json([
            'status' => 'success',
            'message' => 'Cart count successfully.',
            'result' => $result,
        ]);
    }

    public function getCartList(Request $request)
    {
        $email = $request->user_email;

        $cartList = Cart::where('user_email', $email)->get();

        return $cartList;
    }

    public function removeCartItem(Request $request)
    {
        $id = $request->id;
        $email = $request->user_email;
        $result = Cart::where('id', $id)->where('user_email', $email)->delete();

        return $result;
    }

    public function cartItemPlus(Request $result)
    {
        $id = $result->id;
        $quanity = $result->quanity;
        $price = $result->price;
        $result = Cart::where('id', $id)->update([
            'quantity' => $quanity + 1,
            'total_price' => $price * ($quanity + 1),
        ]);
        return $result;
    }

    public function cartItemMinus(Request $result)
    {
        $id = $result->id;
        $quanity = $result->quanity;
        $price = $result->price;
        $result = Cart::where('id', $id)->update([
            'quantity' => $quanity - 1,
            'total_price' => $price * ($quanity),
        ]);
        return $result;
    }

    public function order(Request $request)
    {
        $email = $request->user_email;
        $cartList = Cart::where('user_email', $email)->get();

        date_default_timezone_set('Canada/Atlantic');

        foreach ($cartList as $item) {

            $result = CartOrder::insert([
                'invoice_number' => rand(1, 1000000),
                'product_code' => $item['product_code'],
                'size' => $item['product_size'],
                'color' => $item['color'],
                'email' => $email,
                'product_name' => $item['product_name'],
                'total_price' => $item['total_price'],
                'unit_price' => $item['unit_price'],
                'quantity' => $item['quantity'],
                'delivery_address' => $request->delivery_address,
                'contact' => $request->contact,
                'delivery_charge' => $request->delivery_charge,
                'order_date' => Carbon::now()->format('Y-m-d'),
                'order_time' => Carbon::now()->format('H:i:s'),
                'payment_method' => $request->payment_method,
                'order_status' => 'pending',
                'urgent_delivery' => $request->urgent_delivery,
            ]);
        }
            if ($result == 1) {
                Cart::where('user_email', $email)->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Order placed successfully.',
                ]);
            }
        

        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong.',
        ]);
    }

    public function orderHistory(Request $request)
    {
        $email = $request->user_email;
        $orderList = CartOrder::where('email', $email)
            ->orderBy('id', 'desc')
            ->get();

        return $orderList;
    }

    // using for backend admin panel
    public function pending(){
        $pending_orders = CartOrder::where('order_status', 'pending')->orderBy('id', 'desc')->paginate(10);
        return view('backend.orders.pending', compact('pending_orders'));
    }

    public function processing(){
        $processing_orders = CartOrder::where('order_status', 'process')->orderBy('id', 'desc')->paginate(10);
        return view('backend.orders.processing', compact('processing_orders'));
    }

    public function completed(){
        $completed_orders = CartOrder::where('order_status', 'complete')->orderBy('id', 'desc')->paginate(10);
        return view('backend.orders.completed', compact('completed_orders'));
    }

    public function status(Request $request){
        $order = CartOrder::find($request->id);
        $order->order_status = $request->order_status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
