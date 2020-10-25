<?php


namespace App\Models\Exceptions;


use Throwable;

class NotAllowedException extends BaseException
{
    public function __construct($message = "Действие не разрешено!", $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
