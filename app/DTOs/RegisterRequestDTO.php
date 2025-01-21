<?php

// app/DTOs/RegisterRequestDTO.php
namespace App\DTOs;

class RegisterRequestDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly ?int $id = null
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            id: $data['id'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'id' => $this->id,
        ];
    }
}


?>