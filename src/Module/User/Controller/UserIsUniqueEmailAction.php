<?php

declare(strict_types=1);

namespace App\Module\User\Controller;

use App\Module\Common\Controller\Base\AbstractController;
use App\Module\User\Entity\User;
use App\Module\User\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CheckEmailController
 *
 * @package App\Controller
 */
class UserIsUniqueEmailAction extends AbstractController
{
    public function __invoke(User $data, UserRepository $userRepository): Response
    {
        return $this->responseNormalized([
            'isUnique' => null === $userRepository->findOneByEmail($data->getEmail())
        ]);
    }
}
