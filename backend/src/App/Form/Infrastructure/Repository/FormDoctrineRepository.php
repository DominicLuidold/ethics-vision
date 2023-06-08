<?php

declare(strict_types=1);

namespace App\Form\Infrastructure\Repository;

use App\Common\Domain\Id\FormId;
use App\Form\Domain\Model\Form\Form;
use App\Form\Domain\Repository\FormRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Form>
 */
final class FormDoctrineRepository extends ServiceEntityRepository implements FormRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Form::class);
    }

    public function findOneById(FormId $id): ?Form
    {
        $qb = $this->createQueryBuilder('form')
            ->addSelect('welcomeScreenScreen')
            ->addSelect('submitScreen')
            ->addSelect('sections')
            ->addSelect('elements')
            ->leftJoin('form.welcomeScreen', 'welcomeScreenScreen')
            ->leftJoin('form.submitScreen', 'submitScreen')
            ->leftJoin('form.sections', 'sections')
            ->leftJoin('sections.elements', 'elements')
            ->andWhere('form.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
