<?php
namespace Apsg\MF\Tests;

use Apsg\MF\MF;
use GuzzleHttp\Client;

class SearchNipTest extends TestCase
{
    /** @test */
    public function it_searches_for_valid_nip()
    {
        // given
        $nip = '1111111111';

        // when
        $mf = new MF(new Client(), 'https://wl-test.mf.gov.pl/api');
        $response = $mf->searchNip($nip);

        // then
        dd($response);
    }
}
