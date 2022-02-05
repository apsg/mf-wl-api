<?php
namespace Apsg\MF\Requests;

use Apsg\MF\Responses\Errors\ErrorResponse;
use Apsg\MF\Responses\Errors\NotFoundResponse;
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

        if ($this->isEmptyResponse($responseData)) {
            return new NotFoundResponse();
        }
    }

    protected function isEmptyResponse(mixed $responseData) : bool
    {
        if (!Arr::has($responseData, 'subject')) {
            return true;
        }

        if (empty(Arr::get($responseData, 'subject'))) {
            return true;
        }

        return false;
    }
}
