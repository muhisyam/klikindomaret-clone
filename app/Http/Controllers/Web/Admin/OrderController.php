<?php

namespace App\Http\Controllers\Web\Admin;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    /**
     * Api endpoint
     *
     * @var string
     */
    protected string $endpoint;
    
    /**
     * Username that has authenticated
     *
     * @var string
     */
    protected string $username;

    /**
     * User authentocation token
     *
     * @var string
     */
    protected string $userToken;

    /**
     * Create a new resource instance.
     *
     * @return void
     */
    public function __construct(
        protected ClientRequestAction $clientAction,
    ) {
        $this->endpoint = config('api.url') . 'orders/admin/';
    }

    /**
     * Direct to admin order list page.
     */
    public function index(): View
    {
        return view('admin.order.index');
    }

    /**
     * Retieve retailer order list in admin page.
     */
    public function getDataRetailerOrders(): array
    {
        $this->initUserSession();

        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint . $this->username,
                headers: [
                    'Authorization' => 'Bearer ' . $this->userToken
                ],
            )
        );
    }

    /**
     * Direct to admin order detail page.
     */
    public function show(string $username, string $orderKey): View
    {
        return view('admin.order.detail', [
            'orderKey' => $orderKey
        ]);
    }

    /**
     * Retieve retailer detail order in admin page.
     */
    public function getDataRetailerDetailOrder(string $orderKey): array
    {
        $this->initUserSession();

        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint . $this->username . '/order/' . $orderKey,
                headers: [
                    'Authorization' => 'Bearer ' . $this->userToken
                ],
            )
        );
    }

    /**
     * Update the retailer order status of spesific order.
     */
    public function update(string $orderKey, string $status, string $message)
    {
        $this->initUserSession();

        $response = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint . $this->username . '/order/' . $orderKey,
                headers: [
                    'Authorization' => 'Bearer ' . $this->userToken
                ],
                formData: [
                    '_method' => 'put',
                    'status'  => $status,
                    'message' => $message,
                ]
            )
        );

        dd($response);
    }

    /**
     * Initialize the necessary user session data.
     */
    private function initUserSession()
    {
        $this->username  = session('user')['username'];
        $this->userToken = session('auth_token');
    }
}
