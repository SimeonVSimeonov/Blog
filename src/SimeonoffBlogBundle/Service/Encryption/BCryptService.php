<?php


namespace SimeonoffBlogBundle\Service\Encryption;


class BCryptService implements EncryptionServiceInterface
{

    /**
     * @param string $password
     * @return mixed
     */
    public function hash(string $password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param string $password
     * @param string $hash
     * @return mixed
     */
    public function verify(string $password, string $hash)
    {
        return password_verify($password, $hash);
    }
}