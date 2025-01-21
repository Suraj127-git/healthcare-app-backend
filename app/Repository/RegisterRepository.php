<?php
namespace App\Repository;

use App\DTOs\RegisterRequestDTO;

interface RegisterRepository {
    public function registerCreate(array $registerInsertBo): ?array;
    public function registerGet(array $registerGetBo): ?array;
}