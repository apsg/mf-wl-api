<?php
namespace Apsg\MF;

use Apsg\MF\Requests\BaseRequest;
use Apsg\MF\Requests\NipRequest;
use Apsg\MF\Responses\Response;
use GuzzleHttp\Client;

class MF
{
    protected ?Client $client;
    protected ?string $baseUrl;

    public function __construct(Client $client = null, string $baseUrl = null)
    {
        $this->client = $client ?? new Client();
        $this->baseUrl = $baseUrl ?? BaseRequest::URL;
    }

    public function searchNip(string $nip) : Response
    {
        return (new NipRequest($this->client, $this->baseUrl))->get($nip);
    }
}
