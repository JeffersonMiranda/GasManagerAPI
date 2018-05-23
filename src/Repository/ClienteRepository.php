<?php

namespace App\Repository;

use App\Entity\Cliente as Cliente;
use App\Entity\Endereco as Endereco;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Cliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cliente[]    findAll()
 * @method Cliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClienteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cliente::class);
    }

//    /**
//     * @return Cliente[] Returns an array of Cliente objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cliente
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param $street
     * @return Cliente[]
    */
    public function findByStreet($street){
        $qb = $this->getEntityManager()->createQuery('SELECT c FROM App\Entity\Cliente c LEFT JOIN c.Endereco e WHERE e.rua LIKE :street');
        $qb->setParameter('street','%'.$street.'%');
        return $qb->execute();
    }

    /**
     * @param $name
     * @return Cliente[]
    */
    public function findByName($name){

        $qb = $this->getEntityManager()->createQuery('SELECT c FROM App\Entity\Cliente c WHERE c.nome LIKE :name');
        $qb->setParameter('name','%'.$name.'%');
        return $qb->execute();
    }

}
