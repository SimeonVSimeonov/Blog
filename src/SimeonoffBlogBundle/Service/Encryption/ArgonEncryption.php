<?php


namespace SimeonoffBlogBundle\Service\Encryption;


class ArgonEncryption implements EncryptionServiceInterface
{

    /**
     * @param $password
     * @return mixed
     */
    public function hash($password)
    {
        return password_hash($password, PASSWORD_ARGON2I);
    }

    /**
     * @param $password
     * @param $hash
     * @return mixed
     */
    public function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }
}