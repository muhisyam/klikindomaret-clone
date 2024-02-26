<?php

namespace App\View\Components;

use App\Actions\ClientRequestAction;
use App\Actions\CreateMultipartAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryNavigation extends Component
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
        protected CreateMultipartAction $multipartAction,
    ) {
        $this->endpoint = config('api.url') . 'categories';
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (is_null(session('category_nav_parent'))) {
            session(['category_nav_parent' => $this->getDataCategory()]);
        }

        return view('components.category-navigation', [
            'categoryParent' => session('category_nav_parent')['data'],
        ]);
    }

    public function getDataCategory()
    {
        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint,
            )
        );
    }
}
