<?php

namespace App\Http\Services\NetworkServices;

use App\Http\Interfaces\NetworkServiceInterface;
use GuzzleHttp\Client;

abstract class BaseNetworkService implements NetworkServiceInterface
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    abstract public function handle(string $url): array;

    protected function doRequest(string $url): object
    {
        $response = $this->client->get($url);
        if ($response->getStatusCode() != 200) {
            throw new \Exception('Account not found');
        }

        return json_decode($response->getBody()->getContents());
    }

    abstract public function validateResponse(object $response): bool;

    public function lookupById(string $id): array
    {
        return $this->handle($this->getIdLookupUrl($id));
    }

    public function lookupByUsername(string $username): array
    {
        return $this->handle($this->getUsernameLookupUrl($username));
    }

    protected function getIdLookupUrl(string $id): string
    {
        return 'https://ident.tebex.io/usernameservices/3/username/'.$id;
    }

    protected function getUsernameLookupUrl(string $username): string
    {
        return 'https://ident.tebex.io/usernameservices/3/username/'.$username.'?type=username';
    }
}
