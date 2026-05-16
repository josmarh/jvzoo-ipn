<?php

namespace Josmarh\JVZooIPN\Controllers;

use Josmarh\JVZooIPN\Http\Requests\JVZooIPNRequest;
use Josmarh\JVZooIPN\Services\IPNVerificationService;
use App\Http\Controllers\Controller;

class IPNController extends Controller
{
    public function __invoke(JVZooIPNRequest $request, IPNVerificationService $service)
    {
        try {
            $response = $service->handle(
                $request->validated(),
                $request->getContent()
            );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json($response);
    }
}