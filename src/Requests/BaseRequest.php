<?php
namespace Apsg\MF\Requests;

use Apsg\MF\Exceptions\ModelNotFoundException;
use Apsg\MF\Exceptions\TooManyRequestsException;
use Apsg\MF\Exceptions\WrongInputException;
use Apsg\MF\Responses\Errors\ErrorResponse;
use Apsg\MF\Responses\Errors\NotFoundResponse;
use Apsg\MF\Responses\Models\Subject;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

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
            $url = $this->buildUrl($path, $params);

            return Cache::remember($url, Carbon::now()->addDay(), function () use ($url) {
                return json_decode($this->client->get($url)->getBody()->getContents(),
                    true,
                    512,
                    JSON_THROW_ON_ERROR);
            });
        } catch (ClientException $exception) {
            if ($exception->getCode() === 400) {
                throw new WrongInputException($exception->getMessage(), $exception->getCode());
            }

            if ($exception->getCode() === 404) {
                throw new ModelNotFoundException($exception->getMessage(), $exception->getCode());
            }

            if ($exception->getCode() === 429) {
                throw new TooManyRequestsException($exception->getMessage(), $exception->getCode());
            }

            throw $exception;
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

    protected function getAndParse(string $path, string $identifier) : Subject
    {
        $responseData = $this->makeRequest($path, [$this->sanitizeIdentifier($identifier)]);

        if ($this->isEmptyResponse($responseData, 'result.subject')) {
            throw  new ModelNotFoundException('No results found');
        }

        return new Subject(Arr::get($responseData, 'result.subject'));
    }

    /**
     * @param array $nips
     * @return ErrorResponse|NotFoundResponse|Subject[]
     * @throws ModelNotFoundException
     * @throws TooManyRequestsException
     */
    protected function listAndParse(string $path, array $identifiers) : array
    {
        $responseData = $this->makeRequest($path, $this->sanitizeIdentifier($identifiers));

        if ($this->isEmptyResponse($responseData, 'entries')) {
            return [];
        }

        return $this->parseListOfSubjects($responseData);
    }

    protected function isEmptyResponse(mixed $responseData, string $expectedKey) : bool
    {
        if (!Arr::has($responseData, $expectedKey)) {
            return true;
        }

        if (empty(Arr::get($responseData, $expectedKey))) {
            return true;
        }

        return false;
    }

    /**
     * @return Subject[]
     */
    protected function parseListOfSubjects(array $responseData) : array
    {
        $list = [];
        foreach (Arr::get($responseData, 'entries') as $entries) {
            foreach (Arr::get($entries, 'subjects') as $subject) {
                $list[] = new Subject($subject);
            }
        }

        return $list;
    }

    protected function sanitizeIdentifier(array|string $identifier) : array|string
    {
        return preg_replace('/\D/', '', $identifier);
    }
}
