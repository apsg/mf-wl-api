<?php
namespace Apsg\MF\Responses\Errors;

use Apsg\MF\Responses\Response;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Arr;

class ErrorResponse extends Response
{
    protected array $response;
    public int $code;
    public string $message;

    public function __construct(ClientException $exception)
    {
        $this->code = $exception->getCode();
        $this->response = json_decode($exception->getResponse()->getBody()->getContents(), true, 512,
            JSON_THROW_ON_ERROR);
        $this->message = Arr::get($this->response, 'message');
    }

    public function getInternalCode() : string
    {
        return Arr::get($this->response, 'code', '');
    }
}
