<?php

namespace App\Movies\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ActorRepository
 * @package App\Movies\Repository
 */
class ActorRepository extends EntityRepository
{
    /**
     * @return array|int|string
     */
    public function getActorsPlayedIn2019()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a.firstName, a.lastName FROM AppMovies:Actor a JOIN a.film f WHERE f.releaseYear = :year GROUP BY a.actorId'
            )
            ->setParameter('year', 2019)
            ->getArrayResult();
    }

    /**
     * @return array|int|string
     */
    public function getActorsNotPlayedIn2019()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a1.firstName, a1.lastName FROM AppMovies:Actor a1 WHERE :year NOT IN (SELECT f.releaseYear FROM AppMovies:Actor a2 JOIN a2.film f WHERE a1.actorId = a2.actorId)'
            )
            ->setParameter('year', 2019)
            ->getArrayResult();
    }

    /**
     * @return array|int|string
     */
    public function getActorsPlayedInAtLeast5ComediesOrDramas()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a1.firstName, a1.lastName FROM AppMovies:Actor a1 WHERE :number <= (SELECT COUNT(DISTINCT f.filmId)  FROM AppMovies:Actor a2 JOIN a2.film f JOIN f.category c WHERE c.name  IN (:category1, :category2) AND a1.actorId = a2.actorId)'
            )
            ->setParameter('category1', 'komedia')
            ->setParameter('category2', 'dramat')
            ->setParameter('number', 5)
            ->getArrayResult();
    }
}
