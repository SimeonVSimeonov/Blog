<?php

namespace SimeonoffBlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="SimeonoffBlogBundle\Repository\UserRepository")
 */
class User implements UserInterface
{

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SimeonoffBlogBundle\Entity\Article", mappedBy="author")
     */
    private $articles;

    /**
     * @var string
     *
     * @ORM\Column(name="fullName", type="string", length=255)
     */
    private $fullName;

    /**
     * @var ArrayCollection
     *
     * @ManyToMany(targetEntity="SimeonoffBlogBundle\Entity\Role")
     * @ORM\JoinTable(name="users_roles",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *     )
     */
    private $roles;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        $stringRoles = [];
        foreach ($this->roles as $role)
        {
            /** @var $role Role */
            $stringRoles[] = $role->getRole();
        }
        return $stringRoles;
    }

    /**
     * @param Role $role
     * @return User
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return ArrayCollection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param Article $article
     * @return User
     */
    public function addPost(Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * @param Article $article
     * @return bool
     */
    public function isAuthor(Article $article)
    {
        return $article->getAuthorId() == $this->getId();
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return in_array("ROLE_ADMIN", $this->getRoles());
    }
}

