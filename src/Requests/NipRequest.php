<?php
namespace Apsg\MF\Requests;

use Apsg\MF\Exceptions\ModelNotFoundException;
use Apsg\MF\Exceptions\TooManyRequestsException;
use Apsg\MF\Responses\Errors\ErrorResponse;
use Apsg\MF\Responses\Errors\NotFoundResponse;
use Apsg\MF\Responses\Models\Subject;
use Apsg\MF\Responses\Response;
use Illuminate\Support\Arr;
use JsonException;

class NipRequest extends BaseRequest
{
    public function get(string $nip) : Response
    {
        $responseData = $this->makeRequest('/search/nip/', [$nip]);

        if ($responseData instanceof ErrorResponse) {
            return $responseData;
        }

        if ($this->isEmptyResponse($responseData, 'subject')) {
            return new NotFoundResponse();
        }

        return new Subject(Arr::get($responseData, 'subject'));
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
     * @param array $nips
     * @return ErrorResponse|NotFoundResponse|Subject[]
     * @throws ModelNotFoundException
     * @throws TooManyRequestsException
     * @throws JsonException
     */
    public function list(array $nips)
    {
        $responseData = $this->makeRequest('/search/nips/', $nips);

        if ($responseData instanceof ErrorResponse) {
            return $responseData;
        }

        if ($this->isEmptyResponse($responseData, 'entries')) {
            return new NotFoundResponse();
        }

        return $this->parseListOfSubjects($responseData);
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
}
