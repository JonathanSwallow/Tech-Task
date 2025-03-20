<?php

namespace App\Http\Interfaces;

interface NetworkServiceInterface
{
    public function handle(string $url): array;

    public function lookupById(string $id): array;

    public function lookupByUsername(string $username): array;
}
