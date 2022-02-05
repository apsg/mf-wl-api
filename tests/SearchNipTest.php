<?php
namespace Apsg\MF\Tests;

use Apsg\MF\MF;
use Apsg\MF\Responses\Errors\ErrorResponse;
use Apsg\MF\Responses\Errors\NotFoundResponse;
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
    public function test_invalid_nip_invalid_length()
    {
        // given
        $nip = '11111';

        // when
        $response = $this->mf->searchNip($nip);

        // then
        $this->assertInstanceOf(ErrorResponse::class, $response);
        $this->assertFalse($response->isValid());
        $this->assertEquals(400, $response->code);
        $this->assertEquals(ErrorResponse::CODE_WRONG_NIP_LENGTH, $response->getInternalCode());
    }

    /** @test */
    public function it_tests_invalid_nip_with_valid_length()
    {
        // given
        $nip = '5591903793';

        // when
        $response = $this->mf->searchNip($nip);

        // then
        $this->assertInstanceOf(NotFoundResponse::class, $response);
        $this->assertFalse($response->isValid());
    }
}
