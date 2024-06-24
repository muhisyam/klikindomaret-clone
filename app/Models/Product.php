<?php

namespace App\Models;

use App\Enums\DeployStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'product_images',
        'delete_product_images',
        'retailers_id',
        'many_images',
    ];

    protected $attributes = [
        'model_type' => 'product',
    ];

    protected $casts = [
        'product_deploy_status' => DeployStatus::class,
    ];

    /**
     * Override the route key use other database column for the model class.
     */
    public function getRouteKeyName(): string
    {
        return 'product_slug';
    }

    // Model relationship.

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function descriptions(): HasMany
    {
        return $this->hasMany(ProductDescription::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function retailers(): BelongsToMany
    {
        return $this->belongsToMany(Retailer::class)->withTimestamps();
    }

    // MARK: Related to retailer.
    /**
     * Scope to filter products based on the user's role and retailer association.
     * 
     * If the user has a role of "Super Admin" (or the role defined in the "ROLE_GOD" environment variable),
     * or if the "god" parameter is set in the request, it will filter products that have retailer associations
     * with suppliers marked as official stores. Otherwise, it will filter products that are associated with the
     * user's retailer.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request              $request
    */
    public function scopeRelatedToRetailer(Builder $query, Request $request): Builder
    {
        return $query
            ->when(isGodRole() || hasGodAccess($request),
                fn ($query) => $query->whereHas(
                    // Get products that have retailer assoc.
                    'retailers', fn($retailers) => $retailers->whereHas(
                        // Get retailers with supplier that marked as official stores.
                        'supplier', fn($supplier) => $supplier->where('is_official_store', true)
                    )
                ),
                fn ($query) => $query->whereHas('retailers', fn($query) => $query->where('retailer_id', $request->user()->retailer->id)),
            );
    }

    // MARK: Filter model.
    /**
     * Scope for retrieving filtered data according url parameters.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request              $request
    */
    public function scopeFilterModel(Builder $query, Request $request): Builder
    {
        $search  = $request->search;
        $value   = $request->value;
        $like    = $request->like;
        $between = $request->between;
        $sortBy  = $request->sortBy;
        $sortDir = $request->sortDir;

        return $query
            ->when($search, function($query) use ($search, $value, $like, $between) {
                if($value) {
                    $query->where($search, $value);
                } elseif($like) {
                    $query->where($search, 'LIKE',"%{$like}%");
                } elseif($between) {
                    $query->whereBetween($search, explode('|', $between));
                }
            })
            ->when($sortBy == 'category_name', fn($query) => $query->orderBy('categories.category_name', $sortDir))
            ->when($sortBy == 'product_price', fn($query) => $query->orderByRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE normal_price END ' . $sortDir))
            ->when($sortBy == 'product_name',  fn($query) => $query->orderBy($sortBy, $sortDir))
            ->when($sortBy == 'product_stock', fn($query) => $query->orderBy($sortBy, $sortDir));
    }

    // MARK: Get data.
    /**
     * Scope for retrieving data with or without pagination.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request              $request
    */
    public function scopeGetData(Builder $query, Request $request): LengthAwarePaginator|Collection
    {
        return $request->paginate ? $query->paginate($request->perPage ?? 10) : $query->get();
    }

    // MARK: Get image count.
    /**
     * Retrieves the count of images product.
     *
     * @param string $productSlug
    */
    public static function getImageCount(string $productSlug): int
    {
        $product = Product::query()
            ->where('product_slug', $productSlug)
            ->withCount('images')
            ->first();

        return $product->images_count;
    }

    // MARK: Get keyword list.
    /**
     * Get array of product meta keywords.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
    */
    public function scopeGetKeywordList(Builder $query): string
    {
        $productKeyword    = $query->pluck('product_meta_keyword')->implode(',');
        $arrProductKeyword = explode(',', str_replace(' ', '', $productKeyword));
        
        return implode(',', array_unique($arrProductKeyword));
    }

    // MARK: Get style status stock.
    /**
     * Retrieves the HTML content for displaying the status icon based on product stock availability.
     *
     * @param bool $isProductOnStock Boolean indicating if the product is in stock
    */
    public static function getStyleStatusStock(bool $isProductOnStock): string
    {
        $htmlFormat = "<div class='h-4 me-1'>%s</div>";
        $iconImage  = $isProductOnStock
            ? '<img class="h-4" src="' . asset("img/icons/icon-check.webp") . '"/>'
            : '<img class="h-4" src="' . asset("img/icons/icon-warning-error.webp") . '"/>';

        return sprintf($htmlFormat, $iconImage);
    }
}
