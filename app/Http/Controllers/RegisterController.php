<?php

namespace App\Http\Controllers;

use App\DTOs\RegisterRequestDTO;
use App\Service\RegisterService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function __construct(protected RegisterService $registerService)
    {}

    public function registerProcess(RegisterRequest $request)
    {
        try {
            Log::channel('info')->info('Registration attempt', ['data' => $request->validated()]);
            
            $dto = RegisterRequestDTO::fromRequest($request->validated());
            $response = $this->registerService->register($dto);
            
            if ($response->status === 'success') {
                return response()->json([
                    'message' => $response->message,
                    'data' => $response->data
                ], 201);
            }

            $statusCode = $response->message === 'Email is already registered' ? 422 : 400;
            
            return response()->json([
                'message' => $response->message,
                'errors' => ['email' => [$response->message]]
            ], $statusCode);

        } catch (\Exception $exception) {
            Log::channel('error')->error('Registration failed', [
                'error' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Registration failed',
                'errors' => ['server' => ['An unexpected error occurred']]
            ], 500);
        }
    }
}
