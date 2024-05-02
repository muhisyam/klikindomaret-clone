<?php

namespace App\Services;

use Illuminate\Support\Arr;

class CartService 
{
    //TODO: jadiin [product => ...products, detail => ...details]

    /**
     * Adding additional information including:
     * - product discount percent
     * - total price each product (*quantity)
     * - total price each supplier
     * - total discount
     * - grand total price
     * - delivery options each supplier
     * 
     * @param array $carts Data Model Cart
     * 
     * @return array Adds on information
    */
    public function getMoreInformation(array $carts): array
    {
        $eachProductDiscount  = 0;
        $totalEachSupplier    = 0;
        $grandTotal           = 0;
        $defaultDeliveryOpt   = [];
        $availDeliveryOptions = [
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

        foreach ($carts as $supplierName => $productByGroup) {
            $quantities[$supplierName] = [];
            $totalEachSupplier         = 0;
            
            foreach ($productByGroup as $index => $product) {
                /**
                 * This quantity prop for livewire model purpose, grouped by 
                 * supplier name then has the product inside it. The key each 
                 * product using product slug, the prop will be like 
                 * --> ['Warehouse' => ['product_slug' => 'quantity', etc...]]
                */
                $quantities[$supplierName] = array_merge($quantities[$supplierName], [$product['product_slug'] => $product['quantity']]);
                $discountPercent           = round((($product['normal_price'] - $product['discount_price']) / $product['normal_price']) * 100);
                $eachProductPrice          = $product['quantity'] * ($product['discount_price'] ?? $product['normal_price']);
                $eachProductDiscount      += $product['quantity'] * ($product['normal_price'] - ($product['discount_price'] ?? $product['normal_price']));
                $totalEachSupplier        += $eachProductPrice;
                
                $carts[$supplierName][$index] = array_merge($carts[$supplierName][$index], [
                    'discount_percent' => $discountPercent,
                    'total_price'      => $eachProductPrice,
                ]);
            }
            
            $productCount              = count($productByGroup);
            $supplierIcon              = $supplierName !== 'Toko Indomaret' ? $supplierName : 'Store';
            $availDeliveryOptions      = $this->getFreeDelivery($availDeliveryOptions, $totalEachSupplier);
            $availDeliveryEachSupplier = $supplierName !== 'Toko Indomaret' ? Arr::except($availDeliveryOptions, 'express') : $availDeliveryOptions;
            $deliveryFirstListType     = array_key_first($availDeliveryEachSupplier);
            $deliveryFirstListPrice    = $availDeliveryEachSupplier[$deliveryFirstListType]['price'];
            $deliveryFirstListMessage  = $availDeliveryEachSupplier[$deliveryFirstListType]['message'];
            $grandTotal               += $totalEachSupplier;
            $defaultDeliveryOpt        = array_merge($defaultDeliveryOpt, [
                $supplierName => [
                    'option'  => $deliveryFirstListType,
                    'price'   => $deliveryFirstListPrice,
                    'message' => $deliveryFirstListMessage,
                ]
            ]);


            $carts[$supplierName] = array_merge($carts[$supplierName], [
                'supplier_icon'             => $supplierIcon,
                'total_price_each_supplier' => $totalEachSupplier,
                'product_count'             => $productCount,
                'delivery_options'          => $availDeliveryEachSupplier,
            ]);
        }

        $carts = array_merge($carts, [
            'default_delivery_option'   => $defaultDeliveryOpt,
            'qty_product_each_supplier' => $quantities,
            'total_product_discount'    => $eachProductDiscount,
            'grand_total'               => $grandTotal
        ]);

        return $carts;
    }

    private function getFreeDelivery(array $availDeliveryOptions, int $totalEachSupplier)
    {
        if ($totalEachSupplier >= 150000) {
            $availDeliveryOptions['express']['price'] = 0;
        }

        if ($totalEachSupplier >= 100000) {
            $availDeliveryOptions['sameday']['price'] = 0;
        }

        if ($totalEachSupplier >= 50000) {
            $availDeliveryOptions['time']['price'] = 0;
        }

        return $availDeliveryOptions;
    }
}