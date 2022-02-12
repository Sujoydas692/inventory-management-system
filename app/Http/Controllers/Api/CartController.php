<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        $product = DB::table('products')->where('id', $id)->first();
//        $product_decrement = DB::table('products')->where('id', $id)->decrement('product_quantity');

        $check = DB::table('pos')->where('pro_id', $id)->first();

        if ($check){
            DB::table('pos')->where('pro_id', $id)->increment('pro_quantity');

            $pro = DB::table('pos')->where('pro_id', $id)->first();
            $subtotal = $pro->pro_quantity * $pro->pro_price;
            DB::table('pos')->where('pro_id', $id)->update(['sub_total' => $subtotal]);
        }else {
            $data = array();
            $data['pro_id'] = $id;
            $data['pro_name'] = $product->product_name;
            $data['pro_quantity'] = 1;
            $data['pro_price'] = $product->selling_price;
            $data['sub_total'] = $product->selling_price;

            DB::table('pos')->insert($data);
        }

    }

    public function CartProduct(){
       $cart = DB::table('pos')->get();
       return response()->json($cart);
    }

    public function RemoveCart($id){
        DB::table('pos')->where('id', $id)->delete();
        return response('Done');
    }

    public function increment($id){
        $qty = DB::table('pos')->where('id', $id)->increment('pro_quantity');
        $pro = DB::table('pos')->where('id', $id)->first();
        $subtotal = $pro->pro_quantity * $pro->pro_price;
        DB::table('pos')->where('id', $id)->update(['sub_total' => $subtotal]);
        return response('Done');
    }

    public function decrement($id){
        $qty = DB::table('pos')->where('id', $id)->decrement('pro_quantity');
        $pro = DB::table('pos')->where('id', $id)->first();
        $subtotal = $pro->pro_quantity * $pro->pro_price;
        DB::table('pos')->where('id', $id)->update(['sub_total' => $subtotal]);
        return response('Done');
    }

    public function Vats(){
        $vat = DB::table('extra')->first();
        return response()->json($vat);
    }
}
