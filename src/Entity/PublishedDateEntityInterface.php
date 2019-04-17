<?php
/**
 * Created by PhpStorm.
 * User: youssef
 * Date: 20/03/2019
 * Time: 22:56
 */

namespace App\Entity;


interface PublishedDateEntityInterface
{
    public function setPublished(\DateTimeInterface $published): PublishedDateEntityInterface;
}