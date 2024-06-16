<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\MetaStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\SelectCategoryMinimalResource;
use App\Models\Category;
use Illuminate\Http\Request;

class MinimalCategoryController extends Controller
{
    /**
     * Minimal data categories for data select purposes.
    */
    public function __invoke(Request $request)
    {
        $addtional  = MetaStatus::get('OK');
        $categories = Category::query()
            ->filterByRequest($request)
            ->paginate(10);

        $preventFromSpesificRequest = $request->from != 'child' || $request->slug;

        if ($preventFromSpesificRequest) {
            $addtional = array_merge($addtional, [
                'data' => [
                    [
                        "id"             => 0,
                        "category_name"  => "Induk Kategori",
                        "category_level" => "Kategori level 0",
                        "parent"         => null
                    ]
                ]
            ]);
        }

        return SelectCategoryMinimalResource::collection($categories)->additional($addtional);
    }
}