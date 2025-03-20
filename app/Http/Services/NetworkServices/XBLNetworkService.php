<?php

namespace App\Http\Services\NetworkServices;

class XBLNetworkService extends BaseNetworkService
{
    public function handle(string $url): array
    {
        $response = parent::doRequest($url);
        if (! $this->validateResponse($response)) {
            throw new \Exception('Unable to find acount on XBL');
        }

        return [
            'username' => $response->username,
            'id' => $response->id,
            'avatar' => $response->meta->avatar,
        ];
    }

    public function validateResponse(object $response): bool
    {
        if (empty($response) || isset($response->error)) {
            return false;
        }

        return true;
    }
}
