<?php

namespace App\Services\Remotes\Contracts;

use Illuminate\Http\Client\Factory;

abstract class AbstractRemoteRepository implements RemoteRepositoryInterface
{
    protected $client;

    public function __construct(Factory $client)
    {
        $this->client = $client->withHeaders([
            'Accept' => 'application/json',
            'x-token' => env('X_TOKEN')
        ]);
    }
}
