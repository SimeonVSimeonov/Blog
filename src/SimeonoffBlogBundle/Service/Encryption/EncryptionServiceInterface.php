<?php


namespace SimeonoffBlogBundle\Service\Encryption;


interface EncryptionServiceInterface
{
    /**
     * @param $password
     * @return mixed
     */
    public function hash(string $password);

    /**
     * @param $password
     * @param $hash
     * @return mixed
     */
    public function verify(string $password, string $hash);
}