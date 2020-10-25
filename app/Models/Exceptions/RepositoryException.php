<?php


namespace App\Models\Exceptions;


use Throwable;

class RepositoryException extends BaseException
{
    public function __construct($message = "", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}