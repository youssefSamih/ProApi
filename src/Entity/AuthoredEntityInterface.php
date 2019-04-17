<?php
/**
 * Created by PhpStorm.
 * User: youssef
 * Date: 20/03/2019
 * Time: 22:49
 */

namespace App\Entity;


use Symfony\Component\Security\Core\User\UserInterface;

interface AuthoredEntityInterface
{
    public function setAuthor(UserInterface $user): AuthoredEntityInterface;
}