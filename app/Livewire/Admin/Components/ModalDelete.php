<?php

namespace App\Livewire\Admin\Components;

use App\Http\Responses\ClientErrorResponse;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Features\SupportEvents\Event;

class ModalDelete extends Component
{
    /**
     * Modal section name.
     *
     * @var string
    */
    public string $section = 'modal-delete';

    /**
     * Modal show condition.
     *
     * @var bool
     */
    public bool $showCondition = false;

    /**
     * Checkbox checked.
     *
     * @var bool
    */
    public bool $checkbox = false;

    /**
     * List model controller name.
     * 
     * @var array
    */
    public array $modelController = [
        'category' => 'Category',
        'product'  => 'Product',
        'featured' => 'Featured',
    ];

    /**
     * List catalog name in indonesian.
     * 
     * @var array
    */
    public array $catalogList = [
        'category' => 'Kategori',
        'product'  => 'Produk',
        'featured' => 'Konten Unggulan',
    ];

    /**
     * Model name instance.
     * 
     * @var string
    */
    public string $model = '';

    /**
     * Catalog name instance.
     * 
     * @var string
    */
    public string $catalogName = '';

    /**
     * Content name instance.
     * 
     * @var string
    */
    public string $contentName = '';

    /**
     * Content slug instance.
     * 
     * @var string
    */
    public string $contentSlug = '';

    /**
     * Set show condition in false when component first created.
    */
    public function mount(): void
    {
        $this->showCondition = false;
    }

    /**
     * Reinitialized checkbox and show condition, every request.
    */
    public function boot(): void
    {
        $this->checkbox = false;
        $this->showCondition = true;
    }

    /**
     * Set global props.
     * 
     * @param array $data Data from component that providing the event.
    */
    #[On('modal-delete')] 
    public function addModalInfo(array $data): void
    {
        $this->model       = $this->modelController[$data['catalog_model']];
        $this->catalogName = $this->catalogList[$data['catalog_model']];
        $this->contentName = $data['content_name'];
        $this->contentSlug = $data['content_slug'];
    }

    /**
     * Call delete request and validate response status code.
    */
    public function delete(): ClientErrorResponse|Event
    {
        // Set local properties, then call request delete from catalog controller.
        $controller = $this->getModelWebControllerClass($this->model);
        $response   = app($controller)->deleteDataRequest($this->contentSlug);

        if ($response['meta']['status_code'] >= 400) {
            return new ClientErrorResponse($response);
        }

        $this->showCondition = false;

        return $this->dispatch('content-deleted', notif: [
            'title'   => 'Hapus ' . $this->catalogName,
            'message' => $response['data']['content_name'],
        ]);
    }

    /**
     * Create path of model controller.
    */
    private function getModelWebControllerClass(string $model): string
    {
        return 'App\\Http\\Controllers\\Web\\Admin\\' . $model . 'Controller';
    }
    
    public function render()
    {
        return view('livewire.admin.components.modal-delete');
    }
}
