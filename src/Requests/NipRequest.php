<?php
namespace Apsg\MF\Requests;

use Apsg\MF\Responses\Errors\ErrorResponse;
use Apsg\MF\Responses\Errors\NotFoundResponse;
use Apsg\MF\Responses\Models\Subject;
use Apsg\MF\Responses\Response;
use Illuminate\Support\Arr;

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
}
