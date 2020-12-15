<?php


namespace SimeonoffBlogBundle\Service\Users;


use SimeonoffBlogBundle\Entity\User;

interface UserServiceInterface
{
    /**
     * @param string $email
     * @return User|null
     */
    public function findOneByEmail(string $email): ?User;

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool;

    /**
     * @param int $id
     * @return User|null
     */
    public function findOneById(int $id): ?User;

    /**
     * @param User $user
     * @return User|null
     */
    public function findOne(User $user): ?User;

    /**
     * @return User|null
     */
    public function currentUser(): ?User;
}