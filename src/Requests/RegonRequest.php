<?php
namespace Apsg\MF\Requests;

use Apsg\MF\Responses\Models\Subject;

class RegonRequest extends BaseRequest
{
    public function get(string $regon) : Subject
    {
        return $this->getAndParse('/search/regon', $regon);
    }

    public function list(array $regons) : array
    {
        return $this->listAndParse('/search/regons', $regons);
    }
}
