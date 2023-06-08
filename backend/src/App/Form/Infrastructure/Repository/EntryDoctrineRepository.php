<?php

declare(strict_types=1);

namespace App\Form\Infrastructure\Repository;

use App\Common\Domain\Id\EntryId;
use App\Common\Domain\Id\FormId;
use App\Form\Domain\Model\Entry\Entry;
use App\Form\Domain\Model\Entry\EntryStatus;
use App\Form\Domain\Repository\EntryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Framework\Infrastructure\Repository\RepositoryTrait;

/**
 * @extends ServiceEntityRepository<Entry>
 */
final class EntryDoctrineRepository extends ServiceEntityRepository implements EntryRepositoryInterface
{
    use RepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entry::class);
        $this->em = $this->getEntityManager();
    }

    public function findOneById(EntryId $id): ?Entry
    {
        $qb = $this->createQueryBuilder('entry')
            ->addSelect('elementEntries')
            ->leftJoin('entry.elementEntries', 'elementEntries')
            ->andWhere('entry.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findAll(): array
    {
        $qb = $this->createQueryBuilder('entry')
            ->addSelect('elementEntries')
            ->leftJoin('entry.elementEntries', 'elementEntries');

        return $qb->getQuery()->getResult();
    }

    public function findAllByFormAndStatus(FormId $formId, EntryStatus $status): array
    {
        $qb = $this->createQueryBuilder('entry')
            ->addSelect('elementEntries')
            ->leftJoin('entry.elementEntries', 'elementEntries')
            ->andWhere('entry.form = :formId')
            ->andWhere('entry.status = :status')
            ->setParameter('formId', $formId)
            ->setParameter('status', $status);

        return $qb->getQuery()->getResult();
    }
}
