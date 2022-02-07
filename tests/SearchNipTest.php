<?php
namespace Apsg\MF\Tests;

use Apsg\MF\Exceptions\ModelNotFoundException;
use Apsg\MF\Exceptions\WrongInputException;
use Carbon\Carbon;

class SearchNipTest extends TestCase
{
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
        $nip = static::TEST_NIP;

        // when
        $response = $this->mf->searchNip($nip);

        // then
        $this->assertEquals($nip, $response->nip);
        $this->assertNotEmpty($response->name);
        $this->assertInstanceOf(Carbon::class, $response->registrationLegalDate);
    }
}
