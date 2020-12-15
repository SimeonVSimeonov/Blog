<?php


namespace SimeonoffBlogBundle\Service\Users;


use SimeonoffBlogBundle\Entity\User;
use SimeonoffBlogBundle\Repository\UserRepository;
use SimeonoffBlogBundle\Service\Encryption\ArgonEncryption;
use SimeonoffBlogBundle\Service\Roles\RoleService;
use Symfony\Component\Security\Core\Security;

class UserService implements UserServiceInterface
{
    private Security $security;

    /**
     * @var ArgonEncryption
     */
    private ArgonEncryption $encryptionService;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var RoleService
     */
    private RoleService $roleService;

    /**
     * UserService constructor.
     * @param Security $security
     * @param UserRepository $userRepository
     * @param ArgonEncryption $encryptionService
     * @param RoleService $roleService
     */
    public function __construct(Security $security, UserRepository $userRepository,
                                ArgonEncryption $encryptionService,
                                RoleService $roleService)
    {
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->encryptionService = $encryptionService;
        $this->roleService = $roleService;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findOneByEmail(string $email): ?User
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool
    {
        $passwordHash = $this->encryptionService->hash($user->getPassword());
        $user->setPassword($passwordHash);
        $userRole = $this->roleService->findOneBy("ROLE_USER");
        $user->addRole($userRole);
        return $this->userRepository->insert($user);
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findOneById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param User $user
     * @return User|null
     */
    public function findOne(User $user): ?User
    {
        return $this->userRepository->find($user);
    }

    /**
     * @return User|null|object
     */
    public function currentUser(): ?User
    {
        return $this->security->getUser();
    }
}