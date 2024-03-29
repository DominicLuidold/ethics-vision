<?php

declare(strict_types=1);

namespace Framework\Infrastructure\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Fusonic\DDDExtensions\Domain\Model\EntityInterface;

trait RepositoryTrait
{
    private readonly EntityManagerInterface $em;

    public function saveEntity(EntityInterface $entity): void
    {
        $this->em->persist($entity);
    }
}
