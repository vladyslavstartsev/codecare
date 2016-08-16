<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * UsersRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByProductJoinedToCategory($category)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Category c ORDER BY c.name ASC'
            )->getResult();
    }

    public function loadCategoryByName($category_name)
    {
        $category = $this->findOneByIdOrName($category_name);
        if (!$category) {
            throw new AccessDeniedException('No category found for '.$category_name);
        }

        return $category;
    }
}
