<?php

declare(strict_types=1);

namespace App\Module\User\Controller;

use App\Module\Common\Controller\Base\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserAboutMeAction extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->responseNormalized(
            $this->getUser()
        );
    }
}
