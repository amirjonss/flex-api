<?php

declare(strict_types=1);

namespace App\Module\User\Component\Dtos;

class RefreshTokenDto
{
    public function __construct(private int $id, private int $iat)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIat(): int
    {
        return $this->iat;
    }
}
