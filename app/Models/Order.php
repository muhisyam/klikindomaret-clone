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
    ];

    public static $retailerStatusMessage = [
        'Dibuat'   => 'Pesanan Dibuat',
        'Masuk'    => 'Pesanan Masuk',
        'Diterima' => 'Pesanan diterima oleh',
        'Dikirim',
        'Siap',
        'Selesai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function retailers(): BelongsToMany
    {
        return $this->belongsToMany(Retailer::class)->withTimestamps();
    }

    public function supplierDeliveries(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, 'order_supplier_delivery')->withTimestamps();
    }

    public function pickupAddress(): MorphTo
    {
        return $this->morphTo();
    }
}
