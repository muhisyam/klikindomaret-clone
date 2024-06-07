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
        'delete_category_image'
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
    
    /* All relations of category model. */

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Scope for retrieving filtered data according url parameters.
     * 
     * @param Builder $query
     * @param Request $request
     * @return Builder
    */
    public function scopeFilterModel(Builder $query, Request $request): Builder
    {
        $depth   = $request->depth;
        $minimal = $request->minimal;
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
                           $categoryLv2->with(['children' => fn($categoryLv3) => $categoryLv3->whereNot('category_deploy_status', DeployStatus::DRAFT->value)]); 
                        });
                }]);
            })
            // For minimal resource of category with depth until level 2.
            ->when($minimal, function($query) {
                $query->whereNull('categories.parent_id')
                    ->rightJoin('categories as parent', 'categories.id', '=', 'parent.parent_id')
                    ->orderBy('parent.parent_id', 'asc');
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

    /**
     * Scope for retrieving data with or without pagination.
     * 
     * @param Builder $query
     * @param Request $request
     * @return LengthAwarePaginator|Collection
    */
    public function scopeGetData(Builder $query, Request $request): LengthAwarePaginator|Collection
    {
        return $request->paginate ? $query->paginate($request->perPage ?? 10) : $query->get();
    }

    /**
     * Accessor get image size.
    */ 
    public function getImageSize()
    {
        if (is_null($this->category_image_name)) {
            return null;
        }

        $imagePath = 'img/uploads/categories/' . $this->category_image_name;

        return File::exists($imagePath) ? round(filesize($imagePath) / 1024) . ' kB' : null;
    }
}
