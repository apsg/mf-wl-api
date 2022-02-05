<?php
namespace Apsg\MF;

use Apsg\MF\Requests\BaseRequest;
use Apsg\MF\Requests\NipRequest;
use Apsg\MF\Requests\RegonRequest;
use Apsg\MF\Responses\Models\Subject;
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

    public function searchNip(string $nip) : Subject
    {
        return (new NipRequest($this->client, $this->baseUrl))->get($nip);
    }

    public function searchNips(array $nips = []) : array
    {
        return (new NipRequest($this->client, $this->baseUrl))->list($nips);
    }

    public function searchRegon(string $regon) : Subject
    {
        return (new RegonRequest($this->client, $this->baseUrl))->get($regon);
    }

    public function searchRegons(array $regons = []) : array
    {
        return (new RegonRequest($this->client, $this->baseUrl))->list($regons);
    }

}
