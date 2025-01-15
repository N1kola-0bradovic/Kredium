<?php

namespace App;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection as CollectionType;

interface ClientRepositoryInterface
{
    public function all(): CollectionType;
    public function find(Client $client): Client;
    public function create(array $data): Client;
    public function update(Client $client, array $data): Client;
    public function delete(Client $client): void;
}
