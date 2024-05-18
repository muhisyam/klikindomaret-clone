<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [
        'product_ids', 
        'retailer_ids',
    ];

    public static $userStatus = [
        'create'     => 'Dibuat',
        'expire'     => 'Kadaluwarsa',
        'pending'    => 'Menunggu Pembayaran',
        'settlement' => 'Sedang Diproses',
        'completed'  => 'Selesai',
    ];
    
    public static $retailerStatus = [
        'create'   => 'Dibuat',
        'incoming' => 'Masuk',
        'accept'   => 'Diterima',
        'delivery' => 'Dikirim',
        'ready'    => 'Siap',
        'complete' => 'Selesai',
        'expire'   => 'Kadaluwarsa',
    ];

    public static $retailerStatusMessage = [
        'Dibuat'      => 'Pesanan Dibuat',
        'Masuk'       => 'Pesanan Masuk',
        'Diterima'    => 'Pesanan diterima oleh',
        'Diproses'    => 'Pesanan sedang diproses oleh',
        'Dikirim'     => 'Pesanan sudah dikirim oleh',
        'Siap'        => 'Pesanan siap diambil',
        'Selesai'     => 'Pesanan telah diambil',
        'Kadaluwarsa' => 'Pesanan kadaluwarsa',
    ];

    /**
     * Status based on confirmation from the retailer.
    */
    public static $basedOnRetailer = [
        'Diterima', 'Diproses', 'Dikirim'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('price', 'quantity')
            ->withTimestamps();
    }

    public function retailers(): BelongsToMany
    {
        return $this->belongsToMany(Retailer::class)
            ->withPivot('retailer_order_status', 'message')
            ->withTimestamps();
    }

    public function supplierDeliveries(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, 'order_supplier_delivery')
            ->withPivot('delivery_option', 'expected_time_between', 'expected_pickup_date', 'delivery_price')
            ->withTimestamps();
    }

    public function pickupAddress(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeGetUserModalOrder($query, $orderKey): Order
    {
        $result = $query
            ->with([
                'products' => [
                    'supplier', 
                    'images'
                ], 
                'supplierDeliveries',
                'pickupAddress.region',
                'retailers' => function($retailer) {
                    return $retailer->whereNot('retailer_order_status', 'Masuk');
                },
            ])
            ->where('order_key', $orderKey)
            ->first();

        // TODO: fix when data not found

        $result->products   = $result->products->groupBy('supplier.supplier_name');
        $result->deliveries = $result->supplierDeliveries->groupBy('supplier_name');

        return $result;
    }

    public static function getHeaderStyle(string $label)
    {
        return match ($label) {
            self::$userStatus['expire']     => 'bg-danger-100 text-danger',
            self::$userStatus['pending']    => 'bg-primary-100 text-primary-600',
            self::$userStatus['settlement'] => 'bg-primary-100 text-primary-600',
            self::$userStatus['completed']  => 'bg-success-100 text-success-600',
            default                         => '',
        };
    }

    public static function getIconColorStyle(string $label)
    {
        return match ($label) {
            self::$userStatus['expire']     => 'filter-danger',
            self::$userStatus['pending']    => 'filter-primary',
            self::$userStatus['settlement'] => 'filter-primary',
            self::$userStatus['completed']  => 'filter-success',
            default                         => 'grayscale',
        };
    }
}
