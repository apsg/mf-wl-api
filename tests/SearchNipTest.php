<?php
namespace Apsg\MF\Tests;

use Apsg\MF\Exceptions\ModelNotFoundException;
use Apsg\MF\Exceptions\WrongInputException;
use Apsg\MF\MF;
use Carbon\Carbon;
use GuzzleHttp\Client;

class SearchNipTest extends TestCase
{
    private MF $mf;

    protected function setUp() : void
    {
        parent::setUp();

        $this->mf = new MF(new Client(), 'https://wl-test.mf.gov.pl/api');
    }

    /** @test */
    public function it_tests_invalid_nip_invalid_length()
    {
        // given
        $nip = '11111';

        // then
        $this->expectException(WrongInputException::class);

        // when
        $response = $this->mf->searchNip($nip);
    }

    /** @test */
    public function it_tests_invalid_nip_with_valid_length()
    {
        // given
        $nip = '1111111111';

        // then
        $this->expectException(ModelNotFoundException::class);

        // when
        $response = $this->mf->searchNip($nip);
    }

    /** @test */
    public function it_finds_valid_nip()
    {
        // given
        $nip = '5591903793';

        // when
        $response = $this->mf->searchNip($nip);

        // then
        $this->assertEquals($nip, $response->nip);
        $this->assertNotEmpty($response->name);
        $this->assertInstanceOf(Carbon::class, $response->registrationLegalDate);
    }
}
