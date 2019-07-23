<?php


namespace SoftUniBlogBundle\Service\Encryption;


interface EncryptionInterface
{
    public function hash($password);

    public function verify($password, $hash);
}