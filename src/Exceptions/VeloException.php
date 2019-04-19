<?php
namespace Earnould\LaravelVeloApi\Exceptions;
 
use \Exception;
 
class VeloException extends Exception
{
    public function __construct($message, $code = 400)
    {
        parent::__construct($message, $code);
    }
}