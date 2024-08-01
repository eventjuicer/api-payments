<?php

namespace App\Services\Remotes\Contracts;

interface MainRemoteRepositoryInterface
{
    public function getPurchase(string $userId);
    public function getPurchases(string $purchasesIds);
    public function resetPurchase(string $purchaseId);
    public function updatePurchase(string $purchaseId);
}
