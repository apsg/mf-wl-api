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

        $this->mf = new MF();
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
        $nip = ' 525 25-65 1.8,7';
        $nipSanitized = preg_replace('/\D/', '', $nip);

        // when
        $response = $this->mf->searchNip($nip);

        // then
        $this->assertEquals($nipSanitized, $response->nip);
        $this->assertNotEmpty($response->name);
        $this->assertInstanceOf(Carbon::class, $response->registrationLegalDate);
    }
}
