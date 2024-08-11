<?php

declare(strict_types=1);

namespace App\Module\User\Controller;

use App\Component\User\Dtos\UserDto;
use App\Module\Common\Controller\Base\AbstractController;
use App\Module\User\Component\UserFactory;
use App\Module\User\Component\UserManager;
use App\Module\User\Entity\User;

/**
 * Class CreateUserController
 *
 * @package App\Controller
 */
class UserCreateAction extends AbstractController
{
    public function __invoke(User $data, UserFactory $userFactory, UserManager $userManager): User
    {
        $this->validate($data);

        $user = $userFactory->create($data->getEmail(), $data->getPassword());
        $userManager->save($user, true);

        return $user;
    }
}
