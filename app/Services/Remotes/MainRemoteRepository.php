<?php

namespace App\Services\Remotes;

use App\Services\Remotes\Contracts\AbstractRemoteRepository;
use App\Services\Remotes\Contracts\MainRemoteRepositoryInterface;

class MainRemoteRepository extends AbstractRemoteRepository implements MainRemoteRepositoryInterface
{
    private function baseServiceUrl()
    {
        return env('MAIN_API_URL');
    }

    public function getPurchases(array $purchasesIds)
    {
        $response = $this->client->get($this->baseServiceUrl().'purchases', $purchasesIds);

        $body = json_decode($response->body(), true);

        return $body;
    }

    public function getPurchase(string $purchaseId)
    {
        $response = $this->client->get($this->baseServiceUrl().'purchases', $purchaseId);

        $body = json_decode($response->body(), true);

        return $body;
    }

    public function resetPurchase(string $purchaseId)
    {
        $response = $this->client->delete($this->baseServiceUrl().'purchases', $purchaseId);

        $body = json_decode($response->body(), true);

        return $body;
    }

    public function updatePurchase(string $purchaseId)
    {
        $response = $this->client->patch($this->baseServiceUrl().'purchases', $purchaseId);

        $body = json_decode($response->body(), true);

        return $body;
    }
}
