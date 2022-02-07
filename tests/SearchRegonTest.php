<?php
namespace Apsg\MF\Tests;

use Carbon\Carbon;

class SearchRegonTest extends TestCase
{
    /** @test */
    public function it_finds_valid_regon()
    {
        // given
        $regon = '146826296';

        // when
        $response = $this->mf->searchRegon($regon);

        dd($response);

        // then
        $this->assertEquals($regon, $response->regon);
        $this->assertNotEmpty($response->name);
        $this->assertInstanceOf(Carbon::class, $response->registrationLegalDate);
    }
}
