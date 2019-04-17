<?php
/**
 * Created by PhpStorm.
 * User: youssef
 * Date: 04/04/2019
 * Time: 22:58
 */

namespace App\Exception;

use Throwable;

class EmptyBodyException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct('The body of the POST/PUT method cannot be empty', $code, $previous);
    }
}