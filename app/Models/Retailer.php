<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Retailer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'retailer_open' => 'Open',
        'opening_times' => '00:00:00',
        'retailer_open' => '00:00:00',
        'longitude' => 0,
        'latitude' => 0,
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_retailer', 'retailer_id', 'order_id')
            ->withPivot('retailer_order_status', 'message')
            ->withTimestamps();
    }

    public function scopeGetRetailerOrders($query, array $containerIds): object|null
    {
        $createOrder = Order::$retailerStatus['create'];
        $supplierId  = $containerIds[0];
        $retailerId  = $containerIds[1];
        $result      = $this
            ->orders()
            ->with([
                'user',
                'pickupAddress',
                'supplierDeliveries' => fn($delivery) => $delivery->whereIn('supplier_id', $supplierId),
                'products' => function($products) use ($supplierId, $retailerId) {
                    /**
                     * If $retailerId null it means the user retailer is official store supplier, then it will return all
                     * products from official store retailer. Else it will return all products that provide from the retailer.
                    */
                    return is_null($retailerId) 
                        ? $products->whereIn('supplier_id', $supplierId) 
                        : $products->whereHas('retailers', fn ($retailers) => $retailers->where('retailer_id', $retailerId));
                }, 
            ])
            ->whereNot('retailer_order_status', $createOrder);

        return $result;
    }
}
