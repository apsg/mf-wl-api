<?php
namespace Apsg\MF\Responses;

use Carbon\Carbon;
use Illuminate\Support\Arr;

class Response
{
    protected array $data;
    protected array $dates = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function isValid() : bool
    {
        return false;
    }

    public function isError() : bool
    {
        return false;
    }

    public function __get(string $name)
    {
        if (method_exists($this, $name)) {
            return $this->$name;
        }

        if (in_array($name, $this->dates, true)) {
            if ($date = Arr::get($this->data, $name)) {
                return Carbon::parse($date);
            }

            return null;
        }

        return Arr::get($this->data, 'name');
    }
}
