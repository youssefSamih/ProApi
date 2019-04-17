<?php
/**
 * Created by PhpStorm.
 * User: youssef
 * Date: 30/03/2019
 * Time: 15:30
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "post"={
 *              "path"="/users/confirm"
 *          }
 *     },
 *     itemOperations={}
 * )
*/
class UserConfirmation
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=30, max=30)
    */
    public $confirmationToken;
}