<?php
/**
 * Created by PhpStorm.
 * User: youssef
 * Date: 04/04/2019
 * Time: 23:56
 */

namespace App\Exception;

use Throwable;

class InvalidConfirmationTokenException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct('Confirmation Token is invalid', $code, $previous);
    }
}