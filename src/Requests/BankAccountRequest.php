<?php
namespace Apsg\MF\Requests;

use Apsg\MF\Responses\Models\Subject;

class BankAccountRequest extends BaseRequest
{
    public function get(string $accountNumber) : Subject
    {
        return $this->getAndParse('/search/bank-account/', $accountNumber);
    }

    public function list(array $nips) : array
    {
        return $this->listAndParse('/search/bank-account/', $nips);
    }
}
