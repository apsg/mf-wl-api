<?php
namespace Apsg\MF\Requests;

use Apsg\MF\Responses\Models\Subject;

/**
 * @see https://wl-api.mf.gov.pl/#nip?date
 */
class NipRequest extends BaseRequest
{
    public function get(string $nip) : Subject
    {
        return $this->getAndParse('/search/nip', $nip);
    }

    public function list(array $nips) : array
    {
        return $this->listAndParse('/search/nips/', $nips);
    }
}
