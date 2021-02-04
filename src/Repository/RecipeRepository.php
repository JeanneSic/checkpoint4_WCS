<?php

namespace App\Repository;

use App\Entity\Recipe;
use App\Entity\RecipeSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    /**
     * @param string|null $slug
     * @return QueryBuilder
     */
    public function findByType(?string $slug): QueryBuilder
    {
        return $this->createQueryBuilder('r')
            ->join('r.recipeTypes', 't')
            ->where('t.slug = :slug')
            ->setParameter('slug', $slug)
            ->orderBy('r.created_at', 'DESC');
    }

    public function searchRecipes(RecipeSearch $search): QueryBuilder
    {
        $query = $this->createQueryBuilder('r');
        $parameters = [];
        if ($search->getRecipeType()) {
            $query = $query
                ->join('r.recipeTypes', 't')
                ->andWhere('t.id = :recipeType');
            $parameters['recipeType'] = $search->getRecipeType();
        }
        return $query
            ->orderBy('r.created_at', 'DESC')
            ->setParameters($parameters);
    }

//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }


    /*
    public function findOneBySomeField($value): ?NewRecipeType
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
