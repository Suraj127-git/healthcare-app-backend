<?php

namespace App\Http\Controllers;

use App\DTOs\RegisterRequestDTO;
use App\DTOs\RegisterResponseDTO; // Import the RegisterResponseDTO
use App\Service\RegisterService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __construct(protected RegisterService $registerService)
    {}

    public function registerProcess(RegisterRequest $request)
    {
        try {
            Log::channel('info')->info('Registration attempt', ['data' => $request->validated()]);
            
            // Create DTO from validated request data
            $dto = RegisterRequestDTO::fromRequest($request->validated());
            $response = $this->registerService->register($dto);
            
            // Use RegisterResponseDTO for success response
            if ($response->status === 'success') {
                $registerResponseDTO = RegisterResponseDTO::success($response->data);
                $responseData = $registerResponseDTO->toArray(); // Store in a variable
                return response()->json($responseData, 201); // Use the variable here
            }

            $statusCode = $response->message === 'Email is already registered' ? 422 : 400;
            
            // Use RegisterResponseDTO for error response
            $registerResponseDTO = RegisterResponseDTO::error($response->message);
            $errorResponseData = $registerResponseDTO->toArray(); // Store in a variable
            return response()->json($errorResponseData, $statusCode);

        } catch (\Exception $exception) {
            Log::channel('error')->error('Registration failed', [
                'error' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ]);

            // Use RegisterResponseDTO for server error response
            $registerResponseDTO = RegisterResponseDTO::error('An unexpected error occurred');
            $errorResponseData = $registerResponseDTO->toArray(); // Store in a variable
            return response()->json($errorResponseData, 500); // Use the variable here
        }
    }
}