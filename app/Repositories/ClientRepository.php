<?php

namespace App\Repositories;

use App\Models\Client;
use App\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\Collection as CollectionType;

class ClientRepository implements ClientRepositoryInterface
{
    
    public function all(): CollectionType
    {
        return Client::all();
    }

    public function find(Client $client): Client
    {
        return $client;
    }

    public function create(array $data): Client
    {
        return Client::create($data);
    }

    public function update(Client $client, array $data): Client
    {
        $client->update($data);
        return $client;
    }

    public function delete(Client $client): void
    {
        $client->delete();
    }

}