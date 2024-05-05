<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [
        'product_ids', 
        'retailer_ids',
    ];

    public static $userStatus = [
        'create'    => 'Dibuat',
        'pending'   => 'Menunggu Pembayaran',
        'process'   => 'Sedang Diproses',
        'completed' => 'Selesai',
    ];
    
    public static $retailerStatus = [
        'create'   => 'Masuk',
        'accept'   => 'Diterima',
        'delivery' => 'Dikirim',
        'ready'    => 'Siap',
        'complete' => 'Selesai',
    ];

    public static $retailerStatusMessage = [
        'Incoming' => 'Pesanan Masuk',
        'Accepted' => 'Pesanan diterima oleh',
        'Delivered',
        'Ready',
        'Completed',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function retailers(): BelongsToMany
    {
        return $this->belongsToMany(Retailer::class)->withTimestamps();
    }

    public function retailerAddress(): MorphToMany
    {
        return $this->morphedByMany(Retailer::class, 'order_pickup_address')->withTimestamps();
    }

    public function userAddress(): MorphToMany
    {
        return $this->morphedByMany(UserAddress::class, 'order_pickup_address')->withTimestamps();
    }

    public function morphAddressTo(string $addressType): MorphToMany
    {
        return match ($addressType) {
            'retailer'     => $this->retailerAddress(),
            'user_address' => $this->userAddress(),
        };
    }
    
    public function detachMorphAddress(): void
    {
        $this->retailerAddress()->detach();
        $this->userAddress()->detach();
    }
}
