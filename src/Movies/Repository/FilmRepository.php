<?php

namespace App\Movies\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class FilmRepository
 * @package App\Movies\Repository
 */
class FilmRepository extends EntityRepository
{
    /**
     * @return array|int|string
     */
    public function getPolishComedies()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT f.title FROM AppMovies:Film f JOIN f.originalLanguage l JOIN f.category c WHERE c.name = :category AND l.name = :language'
            )
            ->setParameter('category', 'komedia')
            ->setParameter('language', 'polski')
            ->getArrayResult();
    }

    /**
     * @return array|int|string
     */
    public function getPolishFilmsFrom2019GroupedByCategory() {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c.name, COUNT(f.filmId) AS cnt, AVG(f.rating) AS avg_rating FROM AppMovies:Film f JOIN f.originalLanguage l JOIN f.category c WHERE l.name = :language AND f.releaseYear = :year GROUP BY c.name'
            )
            ->setParameter('language', 'polski')
            ->setParameter('year', 2019)
            ->getArrayResult();
    }

    /**
     * @return array|int|string
     */
    public function getBestFilmsGroupedByYear() {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT f1.releaseYear, f1.title, f1.rating FROM AppMovies:Film f1 WHERE f1.rating = (SELECT MAX(f2.rating) FROM AppMovies:Film f2 WHERE f1.releaseYear = f2.releaseYear)'
            )
            ->getArrayResult();
    }
}
