<?php


namespace App\Models\Exceptions;

use Throwable;

class ServiceException extends BaseException
{
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}