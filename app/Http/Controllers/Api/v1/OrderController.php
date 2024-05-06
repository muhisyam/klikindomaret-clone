<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(array $request)
    {
        DB::transaction(function () use ($request) {
            $order       = Order::create($request['order_data']);
            $addressType = $request['pickup_address']['type'];
            $addressId   = $request['pickup_address']['id'];
    
            $order->products()->attach($request['product_ids']);
            $order->retailers()->attach($request['retailer_ids']);
            $order->morphAddressTo($addressType)->attach($addressId);
        });
    }

    public function destroy()
    {
        $order = Order::where('order_key', 'ADMIN-111-T240508')->first();
        $order->delete();
    }
}
