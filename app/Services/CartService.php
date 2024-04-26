<?php

namespace App\Services;

use Illuminate\Support\Arr;

class CartService 
{
    /**
     * Adding additional information including:
     * - product discount percent
     * - total price each product (*quantity)
     * - total price each retailer
     * - total discount
     * - grand total price
     * - delivery options each retailer
     * 
     * @param array $carts Data Model Cart
     * 
     * @return array Adds on information
    */
    public function getMoreInformation(array $carts): array
    {
        $eachProductDiscount  = 0;
        $totalEachRetailer    = 0;
        $grandTotal           = 0;
        $defaultDeliveryOpt   = [];
        $availDeliveryOptions = [//TODO: jadi gratis klo total sub tertentu
            'regular' => [
                'message' => 'Estimasi 2-3 hari',
                'price'   => 5000,
            ],
            'time' => [
                'message' => 'Pilih sendiri waktu yang kamu mau',
                'price'   => 8000,
            ],
            'sameday' => [
                'message' => 'Pesanan dikirim pada hari yang sama',
                'price'   => 10000,
            ],
            'express' => [
                'message' => 'Pesanan dikirim maksimal 1 jam setelah pembayaran lunas',
                'price'   => 12000,
            ],
        ];

        foreach ($carts as $retailerName => $productByGroup) {
            $quantities[$retailerName] = [];
            $totalEachRetailer         = 0;
            
            foreach ($productByGroup as $index => $product) {
                /**
                 * This quantity prop for livewire model purpose, grouped by 
                 * supplier name then has the product inside it. The key each 
                 * product using product slug, the prop will be like 
                 * --> ['Warehouse' => ['product_slug' => 'quantity', etc...]]
                */
                $quantities[$retailerName] = array_merge($quantities[$retailerName], [$product['product_slug'] => $product['quantity']]);
                $discountPercent           = round((($product['normal_price'] - $product['discount_price']) / $product['normal_price']) * 100);
                $eachProductPrice          = $product['quantity'] * ($product['discount_price'] ?? $product['normal_price']);
                $eachProductDiscount      += $product['quantity'] * ($product['normal_price'] - ($product['discount_price'] ?? $product['normal_price']));
                $totalEachRetailer        += $eachProductPrice;
                
                $carts[$retailerName][$index] = array_merge($carts[$retailerName][$index], [
                    'discount_percent' => $discountPercent,
                    'total_price'      => $eachProductPrice,
                ]);
            }
            
            $productCount              = count($productByGroup);
            $retailerIcon              = $retailerName !== 'Toko Indomaret' ? $retailerName : 'Store';
            $availDeliveryEachRetailer = $retailerName !== 'Toko Indomaret' ? Arr::except($availDeliveryOptions, 'express') : $availDeliveryOptions;
            $deliveryFirstListType     = array_key_first($availDeliveryEachRetailer);
            $deliveryFirstListPrice    = $availDeliveryEachRetailer[$deliveryFirstListType]['price'];
            $grandTotal               += $totalEachRetailer + $deliveryFirstListPrice;
            $defaultDeliveryOpt        = array_merge($defaultDeliveryOpt, [
                $retailerName => [
                    'option' => $deliveryFirstListType,
                    'price'  => $deliveryFirstListPrice,
                ]
            ]);


            $carts[$retailerName] = array_merge($carts[$retailerName], [
                'retailer_icon'             => $retailerIcon,
                'total_price_each_retailer' => $totalEachRetailer,
                'product_count'             => $productCount,
                'delivery_options'          => $availDeliveryEachRetailer,
            ]);
        }

        $carts = array_merge($carts, [
            'default_delivery_option'   => $defaultDeliveryOpt,
            'qty_product_each_retailer' => $quantities,
            'total_product_discount'    => $eachProductDiscount,
            'grand_total'               => $grandTotal
        ]);

        return $carts;
    }
}