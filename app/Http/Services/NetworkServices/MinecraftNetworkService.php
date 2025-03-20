<?php

namespace App\Http\Services\NetworkServices;

class MinecraftNetworkService extends BaseNetworkService
{
    public function handle(string $url): array
    {
        $response = parent::doRequest($url);
        if (! $this->validateResponse($response)) {
            throw new \Exception('Unable to find acount on Minecraft');
        }

        return [
            'username' => $response->name,
            'id' => $response->id,
            'avatar' => 'https://crafatar.com/avatars'.$response->id,
        ];
    }

    public function validateResponse(object $response): bool
    {
        if (empty($response) || isset($response->errorMessage)) {
            return false;
        }

        return true;
    }

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
        return "https://sessionserver.mojang.com/session/minecraft/profile/{$id}";
    }

    protected function getUsernameLookupUrl(string $username): string
    {
        return "https://api.mojang.com/users/profiles/minecraft/{$username}";
    }
}
