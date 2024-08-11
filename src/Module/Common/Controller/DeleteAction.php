<?php

declare(strict_types=1);

namespace App\Module\Common\Controller;

use App\Module\Common\Component\Core\MarkEntityAsDeleted;
use App\Module\Common\Controller\Base\AbstractController;
use App\Module\Common\Entity\Interfaces\DeletedAtSettableInterface;
use App\Module\Common\Entity\Interfaces\DeletedBySettableInterface;
use Symfony\Component\HttpFoundation\Response;

class DeleteAction extends AbstractController
{
    public function __invoke(
        DeletedAtSettableInterface|DeletedBySettableInterface $data,
        MarkEntityAsDeleted $markEntityAsDeleted
    ): Response {
        $markEntityAsDeleted->mark($data, true);
        return $this->responseEmpty();
    }
}
