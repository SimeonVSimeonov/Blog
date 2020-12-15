<?php


namespace SimeonoffBlogBundle\Service\Roles;


use SimeonoffBlogBundle\Repository\RoleRepository;

class RoleService implements RoleServiceInterface
{
    /**
     * @var RoleRepository
     */
    private RoleRepository $roleRepository;

    /**
     * RoleService constructor.
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param string $criteria
     * @return mixed
     */
    public function findOneBy(string $criteria)
    {
        return $this->roleRepository->findOneBy(
            ['name' => $criteria]
        );
    }
}