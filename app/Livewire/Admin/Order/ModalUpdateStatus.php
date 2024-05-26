<?php

namespace App\Livewire\Admin\Order;

use App\Http\Controllers\Web\Admin\OrderController;
use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalUpdateStatus extends Component
{
    /**
     * Modal section name.
     *
     * @var string
    */
    public string $section;

    /**
     * Modal show condition.
     *
     * @var bool
     */
    public bool $showCondition;
    
    /**
     * Data retailer status of order data instance.
     * 
     * @var null|string $retailerStatus
     */
    public null|string $retailerStatus = null;
    
    /**
     * Data retailer name of order data instance.
     * 
     * @var string $retailerStatus
     */
    public string $retailerName;

    /**
     * Order Key from route path.
     * 
     * @var string $orderKey
     */
    public string $orderKey;
    
    #[On('content-loaded')]
    public function loadContent($order)
    {
        $dataOrder            = $order['order'];
        $this->orderKey       = $order['order_key'];
        $this->retailerName   = $dataOrder['retailer_name'];
        $this->retailerStatus = $dataOrder['retailer_order_status'];

        $this->dispatch('content-status-obtained');
    }

    public function updateRetailerStatus()
    {
        /**
         * Get retailer status list from order model
         * 
         * @var array<string, string>
         */
        $retailerStatusList = Order::$retailerStatus;
        
        /**
         * Flip array status list from [Incoming => Masuk] to [Masuk => Incoming]
         * 
         * @var array<string, string>
         */
        $statusKeys = array_flip($retailerStatusList);

        /**
         * Get retailer status key => Incoming
         * 
         * @var string
         */
        $currentKey = $statusKeys[$this->retailerStatus];

        /**
         * Get key list from status list
         * 
         * @var array<int, string>
         */
        $keys = array_keys($retailerStatusList);

        /**
         * Get index key according the current status
         * 
         * @var int|string
         */
        $currentIndex = array_search($currentKey, $keys);

        /**
         * Result the final status and message. Final mean the status is been the value
         * not the array keys. So in update api controller it just place the request as 
         * the update value, not as arr key.s
         */
        $nextIndex    = $currentIndex + 1;
        $finalStatus  = $retailerStatusList[$keys[$nextIndex]];
        $finalMessage = Order::$retailerStatusMessage[$finalStatus] . ' oleh ' . $this->retailerName;

        app(OrderController::class)->update($this->orderKey, $finalStatus, $finalMessage);
    }

    public function render()
    {
        return view('livewire.admin.order.modal-update-status');
    }
}
