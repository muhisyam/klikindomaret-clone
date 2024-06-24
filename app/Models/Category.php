<?php

namespace App\Models;

use App\Enums\DeployStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;

class Category extends Model
{
    use HasFactory;

    /**
     * Specifies which request are not permitted to be included 
     * to mass assignable.
    */
    protected $guarded = [
        'category_image',
        'delete_category_image',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'category_deploy_status' => DeployStatus::DRAFT->value,
        'model_type'             => 'category',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, mixed>
     */
    protected $casts = [
        'category_deploy_status' => DeployStatus::class,
    ];

    /**
     * Override the route key use other database column for the model class.
     */
    public function getRouteKeyName(): string
    {
        return 'category_slug';
    }
    
    // MARK: Model relationship.

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
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
        $depth   = $request->depth;
        $search  = $request->search;
        $value   = $request->value;
        $like    = $request->like;
        $between = $request->between;
        $sortBy  = $request->sortBy;
        $sortDir = $request->sortDir;

        return $query
            // For category data in user client.
            ->when($depth > 1, function($query) use ($depth) {
                $query->with(['children' => function($categoryLvl2) use ($depth) {
                    $categoryLvl2
                        ->whereNot('category_deploy_status', DeployStatus::DRAFT->value)
                        ->when($depth > 2, function($categoryLv2) {
                           $categoryLv2->with([
                                'children' => fn($categoryLv3) => $categoryLv3->whereNot('category_deploy_status', DeployStatus::DRAFT->value)
                            ]); 
                        });
                }]);
            })
            ->when($search, function($query) use ($search, $value, $like, $between) {
                if($value) {
                    $query->where($search, $value);
                } elseif($like) {
                    $query->where($search, 'LIKE',"%{$like}%");
                } elseif($between) {
                    $query->whereBetween($search, explode('|', $between));
                }
            })
            ->when($sortBy == 'category_name',  fn($query) => $query->orderBy($sortBy, $sortDir))
            ->when($sortBy == 'children_count', fn($query) => $query->orderBy($sortBy, $sortDir));
    }

    // MARK: Filter by request.
    /**
     * Scope for filtering the category to get data starting from the specified point based on the request.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query   Category model query
     * @param \Illuminate\Http\Request              $request The request object containing filter parameters
    */
    public function scopeFilterByRequest(Builder $query, Request $request): Builder
    {   
        $formParent = $request->from == 'parent';
        $formChild  = $request->from == 'child';
        $formSlug   = $request->slug;
        $search     = $request->search;

        // If no starting point is specified in the request, just perform a search
        $globalSearch = ! ($request->from && $request->slug) && $search;

        return $query
            ->when($formParent, function($query) use ($search) {
                $query
                    ->whereHas('children')
                    ->when($search, fn($parent) => $parent->where('category_name', 'LIKE', "%{$search}%"));
            })
            ->when($formChild, function($query) use ($search) {
                $query
                    ->whereDoesntHave('children')
                    ->when($search, function($child) use ($search) {
                        $child->where(function($where) use ($search) {
                            $where
                                ->where('category_name', 'LIKE', "%{$search}%")
                                ->orWhereHas('parent', fn ($query) => $query->where('category_name', 'LIKE', "%{$search}%"))
                                ->orWhereHas('parent.parent', fn ($query) => $query->where('category_name', 'LIKE', "%{$search}%"));
                        });
                    });
            })
            ->when($formSlug, fn($query) => $query->where('category_slug', $formSlug))
            ->when($globalSearch, fn($query) => $query->where('category_name', 'LIKE', "%{$search}%"))
            ->with('parent.parent')
            ->orderBy('parent_id', 'asc');
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

    // MARK: Get image size.
    /**
     * Accessor get image size.
    */ 
    public function getImageSize(): null|string
    {
        if (is_null($this->category_image_name)) {
            return null;
        }

        $imagePath = 'img/uploads/categories/' . $this->category_image_name;

        return File::exists($imagePath) ? round(filesize($imagePath) / 1024) . ' kB' : null;
    }
}
