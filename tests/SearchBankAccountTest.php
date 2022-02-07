<?php
namespace Apsg\MF\Tests;

class SearchBankAccountTest extends TestCase
{
    /** @test */
    public function it_finds_valid_account()
    {
        // given
        $number = '32116022020000000247781296';

        // when
        $response = $this->mf->searchBankAccount($number);

        // then

        dd($response);
    }
}
