<?php namespace SpreadOut\Exceptions;

use Exception;

abstract class AbstractException extends Exception {

    protected $statusCode = 400;
    /**
     * @param string $message
     * @param int $status
     * @internal param int $redirectTo
     * @internal param int $code
     */
    public function __construct($message, $status = 400)
    {
        $this->statusCode = $status;

        parent::__construct($message);
    }

    /**
     * Get exception status code
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}