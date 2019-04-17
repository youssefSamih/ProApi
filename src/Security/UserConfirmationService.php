<?php
/**
 * Created by PhpStorm.
 * User: youssef
 * Date: 30/03/2019
 * Time: 18:11
 */

namespace App\Security;


use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Exception\InvalidConfirmationTokenException;
use Psr\Log\LoggerInterface;

class UserConfirmationService
{
    /**
     * @var UserRepository
    */
    private $userRepository;

    /**
     * @var EntityManagerInterface
    */
    private $entityManager;

    /**
     * @var LoggerInterface
    */
    private $logger;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public function confirmUser(string $confirmationToken)
    {
        $this->logger->debug('Fetching user by confirmation token');

        $user = $this->userRepository->findOneBy(
            ['confirmationToken' => $confirmationToken]
        );

        if (!$user){
            $this->logger->debug('User by confirmation token not found');
            throw new InvalidConfirmationTokenException();
        }

        $user->setEnabled(true);
        $user->setConfirmationToken(null);
        $this->entityManager->flush();

        $this->logger->debug('Confirmed user by confirmation token');
    }
}