<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\lookUpRequest;
use App\Http\Services\NetworkServices\BaseNetworkService;

/**
 * Class LookupController
 */
class LookupController extends Controller
{
    private BaseNetworkService $networkService;

    public function __construct(BaseNetworkService $networkService)
    {
        $this->networkService = $networkService;
    }

    public function lookup(lookUpRequest $request)
    {
        if (isset($request->id)) { // Ran out of time but this could be done alot better!
            return response()->json($this->networkService->lookupById($request->id));
        } else {
            return response()->json($this->networkService->lookupByUsername($request->username));
        }
    }
}
