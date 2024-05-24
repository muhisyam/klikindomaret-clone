<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'Diterima'    => 'Pesanan diterima',
        'Diproses'    => 'Pesanan sedang diproses',
        'Dikirim'     => 'Pesanan sudah dikirim',
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

    /**
     * Override the route key use other database column for the model class.
     */
    public function getRouteKeyName(): string
    {
        return 'order_key';
    }

    // All relations of order model.

    public function user(): BelongsTo
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

    /**
     * Scope to get list of retailer order in admin page.
     * 
     * @param $query
     * @param array<int, string> $containerIds The order is supplierId, retailerId
     * @return Builder
    */
    public function scopeGetListRetailerOrders($query, array $containerIds): Builder
    {
        $supplierId  = $containerIds[0];
        $retailerId  = $containerIds[1];
        $result      = $query
            ->with([
                'user',
                'pickupAddress',
                /**
                 * Why use whereIn, just to be safe if the retailer chosen by the user is an official store. So it will 
                 * retrieve all data related to the official store.
                 */
                'supplierDeliveries' => fn($delivery) => $delivery->whereIn('supplier_id', $supplierId),
                'retailers'          => fn($retailer) => $retailer->whereIn('supplier_id', $supplierId)->orderByPivot('created_at', 'desc'),
                'products'           => function($products) use ($supplierId, $retailerId) {
                    /**
                     * If $retailerId null it means the user retailer is official store supplier, then it will return all
                     * products from official store retailer. Else it will return all products that provide from the retailer.
                    */
                    return is_null($retailerId) 
                        ? $products->whereIn('supplier_id', $supplierId) 
                        : $products->whereHas('retailers', fn ($retailers) => $retailers->where('retailer_id', $retailerId));
                }, 
            ]);

        return $result;
    }

    /**
     * Accessor to get detail retailer order in admin page.
     * 
     * @param array<int, string> $containerIds The order is supplierId, retailerId
     * @return Order
    */
    public function getDetailRetailerOrder(array $containerIds): Order
    {
        $supplierId  = $containerIds[0];
        $retailerId  = $containerIds[1];
        $result      = $this
            ->load([
                'user',
                'pickupAddress',
                /**
                 * Why use whereIn, just to be safe if the retailer chosen by the user is an official store. So it will 
                 * retrieve all data related to the official store.
                 */
                'supplierDeliveries' => fn($delivery) => $delivery->whereIn('supplier_id', $supplierId),
                'retailers'          => fn($retailer) => $retailer->whereIn('supplier_id', $supplierId)->orderByPivot('created_at', 'desc'),
                'products'           => function($products) use ($supplierId, $retailerId) {
                    /**
                     * If $retailerId null it means the user retailer is official store supplier, then it will return all
                     * products from official store retailer. Else it will return all products that provide from the retailer.
                    */
                    return is_null($retailerId) 
                        ? $products->whereIn('supplier_id', $supplierId) 
                        : $products->whereHas('retailers', fn ($retailers) => $retailers->where('retailer_id', $retailerId));
                }, 
            ]);

        return $result;
    }

    public static function getHeaderStyle(string $label): string
    {
        return match ($label) {
            self::$userStatus['expire']     => 'bg-danger-100 text-danger',
            self::$userStatus['pending']    => 'bg-primary-100 text-primary-600',
            self::$userStatus['settlement'] => 'bg-primary-100 text-primary-600',
            self::$userStatus['completed']  => 'bg-success-100 text-success-600',
            default                         => '',
        };
    }

    public static function getIconColorStyle(string $label): string
    {
        return match ($label) {
            self::$userStatus['expire']     => 'filter-danger',
            self::$userStatus['pending']    => 'filter-primary',
            self::$userStatus['settlement'] => 'filter-primary',
            self::$userStatus['completed']  => 'filter-success',
            default                         => 'grayscale',
        };
    }

    public static function getStyleRetailerStatus(string $label): string
    {
        return match ($label) {
            self::$retailerStatus['incoming'] => 'bg-primary-100 text-primary-600',
            self::$retailerStatus['accept']   => 'bg-primary-100 text-primary-600',
            self::$retailerStatus['delivery'] => 'bg-success-100 text-success-600',
            self::$retailerStatus['ready']    => 'bg-success-100 text-success-600',
            self::$retailerStatus['complete'] => 'bg-secondary-50 text-secondary',
            self::$retailerStatus['expire']   => 'bg-danger-100 text-danger',
            default                           => 'bg-light-gray-100 text-black',
        };
    }
}
