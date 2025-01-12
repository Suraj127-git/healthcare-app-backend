<?php

namespace App\Service;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class LoginService
{
    public function login(array $credentials)
    {
        $currentDateTime = now();

        try {

                Log::channel('warning')->warning("[$currentDateTime]: Authentication failed for credentials");
                return [
                    "message" => "Authentication failed",
                    "status" => "fail",
                ];
            }

            // Get the authenticated user
            // $user = auth('api')->user();
            Log::channel('info')->info("[$currentDateTime]: User authenticated successfully, ID: " . $user->id);

            
        } catch (\Exception $e) {
            Log::channel('error')->error("[$currentDateTime]: Login error: " . $e->getMessage());
            throw $e;
        }
    }
}
