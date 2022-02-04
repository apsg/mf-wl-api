<?php
namespace Apsg\MF\Requests;

use Apsg\MF\Responses\Errors\ErrorResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

abstract class BaseRequest
{
    public const URL = 'https://wl-api.mf.gov.pl/api/';

    protected ?Client $client;

    protected string $baseUrl;

    public function __construct(Client $client = null, string $baseUrl = self::URL)
    {
        $this->client = $client ?? new Client();
        $this->baseUrl = $baseUrl;
    }

    public function makeRequest(string $path, array $params = []) : mixed
    {
        try {
            return json_decode(
                $this->client->get($this->buildUrl($path, $params))->getBody()->getContents(),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (ClientException $exception) {
            return new ErrorResponse($exception);
        }
    }

    protected function buildUrl(string $path, array $params) : string
    {
        $date = date('Y-m-d');

        return rtrim($this->baseUrl, '/')
            . '/'
            . trim($path, '/')
            . '/'
            . implode(',', $params)
            . '?date=' . $date;
    }
}
