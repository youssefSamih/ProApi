<?php
/**
 * Created by PhpStorm.
 * User: youssef
 * Date: 25/03/2019
 * Time: 22:36
 */

namespace App\Controller;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;


class ResetPasswordAction
{
    /**
     * @var ValidatorInterface
    */
    private $validator;

    /**
     * @var UserPasswordEncoderInterface
    */
    private $userPasswordEncoder;

    /**
     * @var EntityManagerInterface
    */
    private $entityManager;

    /**
     * @var JWTTokenManagerInterface
     */
    private $tokenManager;

    public function __construct(ValidatorInterface $validator, UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager, JWTTokenManagerInterface $tokenManager)
    {
        $this->validator = $validator;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
        $this->tokenManager = $tokenManager;


    }

    public function __invoke(User $data)
    {
        $this->validator->validate($data);

        $data->setPassword(
            $this->userPasswordEncoder->encodePassword(
                $data, $data->getNewPassword()
            )
        );

        $data->setPasswordChangeDate(time());

        $this->entityManager->flush();
        $token = $this->tokenManager->create($data);

        return new JsonResponse(['token' => $token]);

        //return new JsonResponse($data);
    }
}