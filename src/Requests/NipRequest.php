<?php
namespace Apsg\MF\Requests;

use GuzzleHttp\Exception\ClientException;

class NipRequest extends BaseRequest
{
    public function get(string $nip)
    {
        return $this->makeRequest('/search/nip/', [$nip]);
    }
}
