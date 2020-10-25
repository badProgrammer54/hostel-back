<?php


namespace App\Models\Exceptions;
use Exception;
use Throwable;

class BaseException extends Exception
{
    /**
     * BaseException constructor.
     * @param $message
     * @param $code
     * @param Throwable|null $previous
     */
    public function __construct($message, $code, ?Throwable $previous)
    {
        parent::__construct($message, $code, $previous);
    }
}