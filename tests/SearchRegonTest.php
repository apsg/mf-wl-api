<?php
namespace Apsg\MF\Tests;

use Apsg\MF\MF;
use Carbon\Carbon;
use GuzzleHttp\Client;

class SearchRegonTest extends TestCase
{
    private MF $mf;

    protected function setUp() : void
    {
        parent::setUp();

        $this->mf = new MF();
    }

    /** @test */
    public function it_finds_valid_regon()
    {
        // given
        $regon = '146826296';

        // when
        $response = $this->mf->searchRegon($regon);

        // then
        $this->assertEquals($regon, $response->regon);
        $this->assertNotEmpty($response->name);
        $this->assertInstanceOf(Carbon::class, $response->registrationLegalDate);
    }
}
