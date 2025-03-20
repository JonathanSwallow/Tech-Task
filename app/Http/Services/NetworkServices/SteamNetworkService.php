<?php

namespace App\Http\Services\NetworkServices;

class SteamNetworkService extends BaseNetworkService
{
    public function handle(string $url): array
    {
        $response = parent::doRequest($url);
        if (! $this->validateResponse($response)) {
            throw new \Exception('Unable to find acount on Steam');
        }

        return [
            'username' => $response->username,
            'id' => $response->id,
            'avatar' => $response->meta->avatar, // Avatar url is correct. It redirects.
        ];
    }

    public function validateResponse(object $response): bool
    {
        if (empty($response) || isset($response->error)) {
            return false;
        }

        return true;
    }

    protected function getIdLookupUrl(string $id): string
    {
        return "https://ident.tebex.io/usernameservices/4/username/{$id}";
    }

    public function lookupByUsername(string $username): array
    {
        return ['Steam only supports IDs'];
    }
}
