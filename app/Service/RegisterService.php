<?php

namespace App\Service;

use Carbon\Carbon;
use App\DTOs\RegisterRequestDTO;
use App\DTOs\RegisterResponseDTO;
use App\Constants\CommonConstant;
use Illuminate\Support\Facades\Log;
use App\Repository\RegisterRepository;

class RegisterService
{
    public function __construct(protected RegisterRepository $registerRepository)
    {}

    public function register(RegisterRequestDTO $dto): RegisterResponseDTO
    {
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');
        try {
            $registerGetBo = [
                "email" => $dto->email,
                "id" => $dto->id,
            ];
            
            Log::channel('info')->info("[$currentDateTime]: DB response from registerGet: " . json_encode($registerGetBo));
            $registerDbResponse = $this->registerRepository->registerGet($registerGetBo);
            
            if ($registerDbResponse) {
                Log::channel('error')->error("[$currentDateTime]: registerDbResponse: " . json_encode($registerDbResponse));
                return RegisterResponseDTO::error('Email is already registered');
            }

            $registerInsertBo = [
                "name" => $dto->name,
                "email" => $dto->email,
                "password" => $dto->password,
            ];
            
            Log::channel('info')->info("Data to be inserted: " . json_encode($registerInsertBo));
            $registerDbResponse = $this->registerRepository->registerCreate($registerInsertBo);
            Log::channel('info')->info("[$currentDateTime] User ID: {$dto->id} - user registration started", ['registerParams' => $registerDbResponse]);
    
            if ($registerDbResponse) {
                Log::channel('info')->info("[$currentDateTime] User ID: {$dto->id} - user data inserted");
                return RegisterResponseDTO::success($registerDbResponse);
            }
            
            Log::channel('error')->error("[$currentDateTime] User ID: {$dto->id} - user data not inserted");
            return RegisterResponseDTO::error('Register Failed');
            
        } catch (\Exception $e) {
            Log::channel('error')->error("[$currentDateTime] Error in RegisterService: ".$e->getMessage(), ['exception' => $e]);
            return RegisterResponseDTO::error('An error occurred while registering user');
        }
    }
}
