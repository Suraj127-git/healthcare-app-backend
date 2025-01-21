<?php
// app/DTOs/RegisterResponseDTO.php
namespace App\DTOs;

class RegisterResponseDTO
{
    public function __construct(
        public readonly string $status,
        public readonly string $message,
        public readonly array $data = []
    ) {}

    public static function success(array $data = []): self
    {
        return new self(
            status: 'success',
            message: 'Register Successful',
            data: $data
        );
    }

    public static function error(string $message): self
    {
        return new self(
            status: 'error',
            message: $message,
            data: []
        );
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }
}
?>