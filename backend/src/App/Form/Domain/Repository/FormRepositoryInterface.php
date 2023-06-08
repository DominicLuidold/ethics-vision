<?php

declare(strict_types=1);

namespace App\Form\Domain\Repository;

use App\Common\Domain\Id\FormId;
use App\Form\Domain\Model\Form\Form;

interface FormRepositoryInterface
{
    public function findOneById(FormId $id): ?Form;
}
