<?php

namespace App\Services\Remotes\Contracts;

interface MainRemoteRepositoryInterface
{
    public function getPurchase(string $userId);
}
