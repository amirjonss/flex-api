<?php

declare(strict_types=1);

namespace App\Module\User\Controller;

use App\Module\Common\Controller\Base\AbstractController;
use App\Module\User\Component\Exceptions\AuthException;
use App\Module\User\Component\TokensCreator;
use App\Module\User\Entity\User;
use App\Module\User\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserAuthAction
 *
 * @package App\Controller
 */
class UserAuthAction extends AbstractController
{
    /**
     * @throws JWTEncodeFailureException
     */
    public function __invoke(
        User $data,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordEncoder,
        TokensCreator $tokensCreator
    ): Response {
        $user = $userRepository->findOneByEmail($data->getEmail());

        if ($user === null) {
            $this->throwInvalidCredentials();
        }

        if (!$passwordEncoder->isPasswordValid($user, $data->getPassword())) {
            $this->throwInvalidCredentials();
        }

        return $this->responseNormalized($tokensCreator->create($user));
    }

    /**
     * @throws AuthException
     */
    private function throwInvalidCredentials(): void
    {
        throw new AuthException('Invalid credentials');
    }
}
