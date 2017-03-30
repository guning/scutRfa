<?php
namespace Exceptions;

class RetrieveAuthorizationCodeException extends \RuntimeException
{
    public function __construct($message = null, $code = null, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    
    public function errorMessageForResponse()
    {
        $errorInfo = include '../resources/lang/zh/qqOauthError.php';
        
    }
    
    public function errorMessageForWriteLog()
    {
        
    }
}

