<?php

declare(strict_types=1);

namespace App\Module\User\Component\Dtos;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class RefreshTokenDto
 *
 * @package App\Component\User\Dtos
 */
class RefreshTokenRequestDto
{
    public function __construct(
        #[Groups(['user:write'])]
        private string $refreshToken
    ) {
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
}
