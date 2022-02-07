<?php
namespace Apsg\MF\Tests;

use Carbon\Carbon;

class SearchRegonTest extends TestCase
{
    /** @test */
    public function it_finds_valid_regon()
    {
        // given
        $regon = static::TEST_REGON;

        // when
        $response = $this->mf->searchRegon($regon);

        // then
        $this->assertEquals($regon, $response->regon);
        $this->assertNotEmpty($response->name);
        $this->assertInstanceOf(Carbon::class, $response->registrationLegalDate);
    }
}
