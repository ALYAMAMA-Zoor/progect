<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
 use Illuminate\Http\Json\Response;

class InvalidOrderException extends Exception
{
    public $message;
public function __construct($message){
    $this->message=$message;
}
    public function report(): void
    {
        // ...
    }
 

    public function render() //:Response
    {
        return response($this->message);
    }
}
