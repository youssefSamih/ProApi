<?php
/**
 * Created by PhpStorm.
 * User: youssef
 * Date: 30/03/2019
 * Time: 18:21
 */

namespace App\Email;

use App\Entity\User;

class Mailer
{
    /**
     * @var \Swift_Mailer
    */
    private $mailer;

    /**
     * @var \Twig_Environement
    */
    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendConfirmationEmail(User $user)
    {
        $body = $this->twig->render(
            'email/confirmation.html.twig',
            [
                'user' => $user
            ]
        );

        $message = (new \Swift_Message('Hello From API Platform !'))
            ->setFrom('api-platform@api.com')
            ->setTo($user->getEmail())
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
}