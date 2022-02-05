<?php
namespace Apsg\MF\Requests;

use Apsg\MF\Responses\Models\Subject;

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
