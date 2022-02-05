<?php
namespace Apsg\MF\Exceptions;

use Exception;

class TooManyRequestsException extends Exception
{
    // The API limits number of requests made from one IP per day.
}
