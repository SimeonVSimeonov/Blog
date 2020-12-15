<?php


namespace SimeonoffBlogBundle\Service\Roles;


interface RoleServiceInterface
{
    /**
     * @param string $criteria
     * @return mixed
     */
    public function findOneBy(string $criteria);
}